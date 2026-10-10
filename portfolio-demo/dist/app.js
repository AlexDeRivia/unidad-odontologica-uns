/* Demostración local: sin cuentas, red ni datos persistentes. */
const panel = document.getElementById('demo-panel');
const toast = document.getElementById('toast');
const dentists = ['Dra. Camila Reyes', 'Dr. Mateo Vega'];
const reasons = ['Evaluación general', 'Limpieza dental', 'Dolor o molestia', 'Control preventivo'];
const slots = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00'];
const dateFormatter = new Intl.DateTimeFormat('es-PE', {day:'numeric', month:'long', year:'numeric'});
const shortDateFormatter = new Intl.DateTimeFormat('es-PE', {day:'numeric', month:'short'});
let activeRole = 'paciente';
let selectedAppointment = 2;
let adminFilter = 'all';
let editingId = null;
let nextId = 5;
let appointments = [];
let draft = {};
let toastTimer;

function localDate(offset = 0) {
  const date = new Date();
  date.setHours(12, 0, 0, 0);
  date.setDate(date.getDate() + offset);
  return date;
}
function isoDate(date) {
  return `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;
}
function nextWorkday(start, count = 1) {
  const date = new Date(start);
  let found = 0;
  while (found < count) {
    date.setDate(date.getDate() + 1);
    if (date.getDay() !== 0 && date.getDay() !== 6) found++;
  }
  return isoDate(date);
}
function dateObject(value) { return new Date(`${value}T12:00:00`); }
function formatDate(value, short = false) { return (short ? shortDateFormatter : dateFormatter).format(dateObject(value)); }
function safe(value) { return String(value).replace(/[&<>"']/g, character => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[character])); }
function statusName(status) { return ({pending:'Pendiente',attended:'Atendida',cancelled:'Cancelada'})[status]; }
function sortAppointments(items) { return [...items].sort((a,b) => `${a.date} ${a.time}`.localeCompare(`${b.date} ${b.time}`)); }
function isValidDate(value) {
  if (!/^\d{4}-\d{2}-\d{2}$/.test(value)) return false;
  const date = dateObject(value);
  return isoDate(date) === value && date > localDate(0) && date.getDay() !== 0 && date.getDay() !== 6;
}
function initialData() {
  const today = isoDate(localDate(0));
  const next = nextWorkday(localDate(0));
  const after = nextWorkday(localDate(0), 2);
  return [
    {id:1, patient:'Valeria · Paciente demo', dentist:dentists[0], date:next, time:'09:00', reason:reasons[0], status:'pending', note:''},
    {id:2, patient:'Paciente demo 02', dentist:dentists[0], date:today, time:'10:00', reason:reasons[1], status:'pending', note:''},
    {id:3, patient:'Paciente demo 03', dentist:dentists[0], date:after, time:'11:00', reason:reasons[2], status:'pending', note:''},
    {id:4, patient:'Paciente demo 04', dentist:dentists[1], date:after, time:'08:00', reason:reasons[3], status:'attended', note:'Control registrado en la demostración.'}
  ];
}
function resetData(showToast = false) {
  appointments = initialData();
  nextId = 5;
  editingId = null;
  selectedAppointment = 2;
  adminFilter = 'all';
  draft = {dentist:dentists[0], reason:reasons[0], date:nextWorkday(localDate(0),2), time:''};
  render();
  if (showToast) announce('Datos de demostración reiniciados.');
}
function announce(message) {
  toast.textContent = message;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toast.classList.remove('show'), 3600);
}
function setRole(role, scroll = false) {
  if (!['paciente','dentista','admin'].includes(role)) return;
  activeRole = role;
  for (const tab of document.querySelectorAll('[data-role]')) {
    const selected = tab.dataset.role === role;
    tab.setAttribute('aria-selected', String(selected));
    tab.tabIndex = selected ? 0 : -1;
  }
  panel.setAttribute('aria-labelledby', `tab-${role}`);
  render();
  if (scroll) document.getElementById('demo').scrollIntoView({behavior:'smooth',block:'start'});
}
function render() {
  panel.innerHTML = activeRole === 'paciente' ? patientView() : activeRole === 'dentista' ? dentistView() : adminView();
}
function statusChip(status) { return `<span class="status ${status}">${statusName(status)}</span>`; }

function patientView() {
  const mine = sortAppointments(appointments.filter(item => item.patient.startsWith('Valeria')));
  const today = dateFormatter.format(localDate(0));
  return `<div class="panel-intro"><div><p class="panel-kicker">Portal paciente</p><h3>Hola, Valeria.</h3><p>Organiza tu próxima visita en unos pasos.</p></div><span class="panel-date">${safe(today)}</span></div>
    <div class="panel-grid"><div class="surface"><h4>${editingId ? 'Reprogramar cita' : 'Reservar una cita'}</h4><p class="surface-sub">Selecciona profesional, motivo y horario.</p>
      <form id="booking-form"><div class="form-grid"><div class="field"><label for="booking-dentist">Profesional</label><select id="booking-dentist" name="dentist">${dentists.map(d => `<option value="${safe(d)}" ${draft.dentist===d?'selected':''}>${safe(d)}</option>`).join('')}</select></div>
      <div class="field"><label for="booking-reason">Motivo</label><select id="booking-reason" name="reason">${reasons.map(r => `<option value="${safe(r)}" ${draft.reason===r?'selected':''}>${safe(r)}</option>`).join('')}</select></div>
      <div class="field full"><label for="booking-date">Fecha</label><input id="booking-date" name="date" type="date" min="${nextWorkday(localDate(0))}" value="${safe(draft.date)}" required></div></div>
      <p class="slot-title">Horarios disponibles</p><div class="slot-grid" id="booking-slots">${slotButtons()}</div><p class="slot-feedback" id="slot-feedback">${isValidDate(draft.date)?'':'Elige un día laborable a partir de mañana.'}</p>
      <div class="form-actions"><button class="small-primary" type="submit">${editingId?'Guardar cambio':'Confirmar reserva'}</button>${editingId?'<button class="small-secondary" type="button" data-action="stop-edit">Salir de edición</button>':''}</div></form></div>
      <aside class="aside-card"><div class="aside-glyph" aria-hidden="true">✳</div><h4>Tu salud, a tiempo.</h4><p>La demo representa el recorrido de reserva del proyecto: elegir una fecha, ver disponibilidad y gestionar el turno.</p><div class="aside-stat">${mine.filter(x=>x.status==='pending').length}<small>${mine.filter(x=>x.status==='pending').length===1?'cita pendiente':'citas pendientes'}</small></div></aside></div>
    <div class="list-section"><div class="list-head"><h4>Mis citas</h4><small>Paciente ficticia</small></div><div class="appointment-list">${mine.length?mine.map(patientItem).join(''):'<div class="empty-note">Todavía no hay citas en esta demostración.</div>'}</div></div>`;
}
function slotButtons() {
  const taken = appointments.filter(item => item.status==='pending' && item.date===draft.date && item.dentist===draft.dentist && item.id!==editingId).map(item=>item.time);
  return slots.map(time=>`<button type="button" class="slot" data-slot="${time}" aria-pressed="${draft.time===time}" ${taken.includes(time)||!isValidDate(draft.date)?'disabled':''}>${time}</button>`).join('');
}
function patientItem(item) {
  return `<div class="appointment-item"><span class="appointment-icon" aria-hidden="true">▦</span><div class="appointment-summary"><strong>${safe(item.reason)}</strong><small>${safe(formatDate(item.date,true))} · ${item.time} · ${safe(item.dentist)}</small></div>${statusChip(item.status)}${item.status==='pending'?`<div class="item-actions"><button type="button" data-action="edit" data-id="${item.id}">Reprogramar</button><button type="button" data-action="cancel" data-id="${item.id}">Cancelar</button></div>`:''}</div>`;
}

function dentistView() {
  const assigned = sortAppointments(appointments.filter(item=>item.dentist===dentists[0] && item.status!=='cancelled'));
  const current = assigned.find(item=>item.id===selectedAppointment) || assigned[0];
  selectedAppointment = current?.id || null;
  return `<div class="panel-intro"><div><p class="panel-kicker">Portal profesional</p><h3>Agenda de atención.</h3><p>Revisa citas y registra el resultado de una atención.</p></div><span class="panel-date">${assigned.length} citas asignadas</span></div>
    <div class="dentist-layout"><div class="dentist-list" aria-label="Citas de la dentista">${assigned.length?assigned.map(item=>`<button type="button" data-action="select-appointment" data-id="${item.id}" aria-current="${item.id===selectedAppointment}"><span class="avatar avatar-red">${safe(item.patient.slice(0,2).toUpperCase())}</span><span><strong>${safe(item.patient)}</strong><small>${safe(formatDate(item.date,true))} · ${item.time} · ${statusName(item.status)}</small></span></button>`).join(''):'<div class="empty-note">No hay citas asignadas.</div>'}</div>
      <div class="surface dentist-detail">${current?`<div class="detail-header"><span class="avatar avatar-red">${safe(current.patient.slice(0,2).toUpperCase())}</span><span><strong>${safe(current.patient)}</strong><small>Ficha de cita ficticia</small></span></div><div class="detail-row"><span>Fecha y hora</span><span>${safe(formatDate(current.date,true))} · ${current.time}</span></div><div class="detail-row"><span>Motivo</span><span>${safe(current.reason)}</span></div><div class="detail-row"><span>Estado</span><span>${statusChip(current.status)}</span></div><div class="detail-status">${current.status==='pending'?`<label class="field" for="care-note"><span>Nota de atención</span><textarea id="care-note" maxlength="240" placeholder="Escribe una nota breve para esta simulación"></textarea></label><button class="small-primary" type="button" data-action="attend" data-id="${current.id}">Marcar como atendida</button>`:`<p><strong>Atención registrada.</strong><br>${safe(current.note||'Sin nota adicional.')}</p>`}</div>`:'<div class="empty-note">Selecciona una cita para ver su detalle.</div>'}</div></div>
    <div class="insight-bar"><span aria-hidden="true">✳</span><span>Este rol reproduce el seguimiento de citas del sistema original. Las notas solo viven en esta sesión de demostración.</span></div>`;
}

function adminView() {
  const counts = {pending:0,attended:0,cancelled:0};
  appointments.forEach(item=>counts[item.status]++);
  const filtered = sortAppointments(appointments.filter(item=>adminFilter==='all'||item.status===adminFilter));
  return `<div class="panel-intro"><div><p class="panel-kicker">Panel administrativo</p><h3>Vista general.</h3><p>El estado de la agenda, de un vistazo.</p></div><span class="panel-date">Datos de ejemplo</span></div>
    <div class="metric-row"><div class="metric"><strong>${appointments.length}</strong><span>Citas registradas</span></div><div class="metric"><strong>${counts.pending}</strong><span>Pendientes</span></div><div class="metric"><strong>${counts.attended}</strong><span>Atendidas</span></div></div>
    <div class="table-title"><h4>Registro de citas</h4><label><span class="sr-only">Filtrar por estado</span><select class="filter-select" id="admin-filter"><option value="all" ${adminFilter==='all'?'selected':''}>Todos los estados</option><option value="pending" ${adminFilter==='pending'?'selected':''}>Pendientes</option><option value="attended" ${adminFilter==='attended'?'selected':''}>Atendidas</option><option value="cancelled" ${adminFilter==='cancelled'?'selected':''}>Canceladas</option></select></label></div>
    <div class="table-wrap"><table class="data-table"><thead><tr><th>Paciente</th><th>Profesional</th><th>Fecha</th><th>Motivo</th><th>Estado</th></tr></thead><tbody>${filtered.length?filtered.map(item=>`<tr><td><strong>${safe(item.patient)}</strong></td><td>${safe(item.dentist)}</td><td>${safe(formatDate(item.date,true))} · ${item.time}</td><td>${safe(item.reason)}</td><td>${statusChip(item.status)}</td></tr>`).join(''):'<tr><td colspan="5">No hay citas con ese estado.</td></tr>'}</tbody></table></div>
    <div class="insight-bar"><span aria-hidden="true">▥</span><span>El panel resume ${counts.pending} ${counts.pending===1?'pendiente':'pendientes'}, ${counts.attended} ${counts.attended===1?'atendida':'atendidas'} y ${counts.cancelled} ${counts.cancelled===1?'cancelada':'canceladas'}. Prueba los otros roles para cambiar estos datos.</span></div>`;
}

document.addEventListener('click', event => {
  const roleTab = event.target.closest('[data-role]');
  if (roleTab) { setRole(roleTab.dataset.role); roleTab.focus(); return; }
  const roleLink = event.target.closest('[data-go-role]');
  if (roleLink) { setRole(roleLink.dataset.goRole, true); return; }
  const slot = event.target.closest('[data-slot]');
  if (slot && !slot.disabled) { draft.time=slot.dataset.slot; document.getElementById('booking-slots').innerHTML=slotButtons(); return; }
  const action = event.target.closest('[data-action]');
  if (!action) return;
  const id = Number(action.dataset.id);
  const item = appointments.find(value=>value.id===id);
  if (action.dataset.action==='edit' && item?.patient.startsWith('Valeria') && item.status==='pending') {
    editingId=id; draft={dentist:item.dentist,reason:item.reason,date:item.date,time:item.time}; render(); document.getElementById('booking-date').focus();
  } else if (action.dataset.action==='cancel' && item?.patient.startsWith('Valeria') && item.status==='pending') {
    item.status='cancelled'; if(editingId===id) editingId=null; render(); announce('Cita de demostración cancelada.');
  } else if (action.dataset.action==='stop-edit') {
    editingId=null; draft={dentist:dentists[0],reason:reasons[0],date:nextWorkday(localDate(0),2),time:''}; render();
  } else if (action.dataset.action==='select-appointment' && item?.dentist===dentists[0]) {
    selectedAppointment=id; render();
  } else if (action.dataset.action==='attend' && item?.dentist===dentists[0] && item.status==='pending') {
    item.note=document.getElementById('care-note').value.trim().slice(0,240);
    item.status='attended'; render(); announce('Atención registrada en la demostración.');
  }
});
document.addEventListener('keydown', event => {
  if (!event.target.matches('[data-role]') || !['ArrowLeft','ArrowRight'].includes(event.key)) return;
  event.preventDefault();
  const roles=['paciente','dentista','admin'];
  const step=event.key==='ArrowRight'?1:-1;
  const role=roles[(roles.indexOf(activeRole)+step+roles.length)%roles.length];
  setRole(role); document.getElementById(`tab-${role}`).focus();
});
document.addEventListener('change', event => {
  if (event.target.id==='admin-filter') { adminFilter=event.target.value; render(); return; }
  if (event.target.id==='booking-dentist') draft.dentist=event.target.value;
  if (event.target.id==='booking-reason') draft.reason=event.target.value;
  if (event.target.id==='booking-date') draft.date=event.target.value;
  if (event.target.id==='booking-dentist'||event.target.id==='booking-date') {
    draft.time=''; document.getElementById('booking-slots').innerHTML=slotButtons();
    document.getElementById('slot-feedback').textContent=isValidDate(draft.date)?'':'Elige un día laborable a partir de mañana.';
  }
});
document.addEventListener('submit', event => {
  if (event.target.id!=='booking-form') return;
  event.preventDefault();
  const data=new FormData(event.target);
  draft.dentist=String(data.get('dentist'));
  draft.reason=String(data.get('reason'));
  draft.date=String(data.get('date'));
  if (!dentists.includes(draft.dentist)||!reasons.includes(draft.reason)||!isValidDate(draft.date)||!slots.includes(draft.time)) {announce('Elige una fecha laborable y un horario disponible.'); return;}
  if (appointments.some(item=>item.id!==editingId && item.status==='pending' && item.patient.startsWith('Valeria') && item.date===draft.date)) {announce('Ya tienes una cita pendiente ese día.'); return;}
  if (appointments.some(item=>item.id!==editingId && item.status==='pending' && item.dentist===draft.dentist && item.date===draft.date && item.time===draft.time)) {announce('Ese horario acaba de ocuparse. Elige otro.'); render(); return;}
  if (editingId) {
    const item=appointments.find(value=>value.id===editingId && value.patient.startsWith('Valeria'));
    if (!item) return;
    Object.assign(item,{dentist:draft.dentist,reason:draft.reason,date:draft.date,time:draft.time});
    editingId=null; announce('Cita reprogramada en la demostración.');
  } else {
    appointments.push({id:nextId++,patient:'Valeria · Paciente demo',dentist:draft.dentist,reason:draft.reason,date:draft.date,time:draft.time,status:'pending',note:''});
    announce('Reserva ficticia confirmada.');
  }
  draft={dentist:dentists[0],reason:reasons[0],date:nextWorkday(localDate(0),2),time:''};
  render();
});
document.getElementById('reset-demo').addEventListener('click',()=>resetData(true));
resetData();
