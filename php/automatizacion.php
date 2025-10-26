<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/stylesautom.css">
  <title>Banorte - Banco en Línea</title>
  
</head>
<body>
  <header>
    <img src="../img/logoBn.png" alt="Banorte Logo">
    <div class="header-links">
      <span class="tit_hed">Preferente</span>
      <span class="tit_hed">Pymes</span>
      <span class="tit_hed">Empresas</span>
      <span class="tit_hed">Gobierno</span>
      <span class="tit_hed">casa de bolsa</span>
      <img class="img_head" src="../img/discapacitado-11.png" alt="">
      <img class="img_head" src="../img/mapas-y-banderas-1.png" alt="">
      <img class="img_head" src="../img/lupa-1.png" alt="">
      <img class="img_head" src="../img/bloqueado-11.png" alt="">
    </div>
  </header>

<nav>
    <div>
        <img class="img_nav" src="../img/cy-t.png" alt="">
        <span>Cuentas y Tarjetas</span>
    </div>
    <div>
        <img class="img_nav" src="../img/credit.png" alt="">
        <span>Créditos</span>
    </div>
    <div>
        <img class="img_nav" src="../img/ae-i.png" alt="">
        <span>Ahorro e Inversión</span>
    </div>
    <div>        
        <img class="img_nav" src="../img/segu.png" alt="">
        <span>Seguros</span>
    </div>
    <div>
        <img class="img_nav" src="../img/inter.png" alt="">
        <span>Internacional</span>
    </div>
    <div>        
        <img class="img_nav" src="../img/sl.png" alt="">
        <span>Servicios en Línea</span>
    </div>
    <div>        
        <img class="img_nav" src="../img/nomi.png" alt="">
        <span>Nómina</span>
    </div>
    <div class="btn_srv">
        <img class="img_nav" src="../img/servi.svg" alt="">
        <span>Servicios</span>
        <div class="services-dropdown">
            <a href="servicios.php">Tus servicios</a>
            <a href="automatizacion.php">Automatizacion y estado</a>
            <a href="radar.php">Radar de eficiencia</a>
            <a href="historial.php">Historial</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </div>
</nav>

<h1>AUTOMATIZACION y ESTATUS</h1>

<div class="grid">
  <div class="card" data-service="LUZ" data-provider="CFE">
    <div class="left">
      <p class="service-title">LUZ</p>
      <p class="provider">PROVEEDOR: <strong>CFE</strong></p>
    </div>

    <div class="card-controls">
      <div class="status pending">Pendiente</div>
      <div class="switch" role="switch" aria-checked="false" tabindex="0"><span class="thumb"></span></div>
      <button class="btn show-info" type="button">Mostrar información</button>
    </div>
  </div>

  <div class="card" data-service="AGUA" data-provider="CONAGUA">
    <div class="left">
      <p class="service-title">AGUA</p>
      <p class="provider">PROVEEDOR: <strong>CONAGUA</strong></p>
    </div>

    <div class="card-controls">
      <div class="status paid">Pagado</div>
      <div class="switch on" role="switch" aria-checked="true" tabindex="0"><span class="thumb"></span></div>
      <button class="btn show-info" type="button">Mostrar información</button>
    </div>
  </div>

  <div class="card" data-service="INTERNET" data-provider="TELMEX">
    <div class="left">
      <p class="service-title">INTETNET</p>
      <p class="provider">PROVEEDOR: <strong>TELMEX</strong></p>
    </div>

    <div class="card-controls">
      <div class="status paid">Pagado</div>
      <div class="switch on" role="switch" aria-checked="true" tabindex="0"><span class="thumb"></span></div>
      <button class="btn show-info" type="button">Mostrar información</button>
    </div>
  </div>

  <div class="card" data-service="GAS" data-provider="CAMPANITA">
    <div class="left">
      <p class="service-title">GAS</p>
      <p class="provider">PROVEEDOR: <strong>CAMPANITA</strong></p>
    </div>

    <div class="card-controls">
      <div class="status pending">Pendiente</div>
      <div class="switch" role="switch" aria-checked="false" tabindex="0"><span class="thumb"></span></div>
      <button class="btn show-info" type="button">Mostrar información</button>
    </div>
  </div>
</div>

<div id="backdrop" class="backdrop" aria-hidden="true">
  <div id="modal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" tabindex="-1">
    <button class="close" id="closeModal" aria-label="Cerrar">✕</button>

    <h3 id="modalTitle">Cambiar Número de Referencia</h3>
    <p id="modalSubtitle" style="margin-top:6px;color:#666;font-size:13px;">Servicio: <strong id="serviceName">—</strong> • Proveedor: <strong id="providerName">—</strong></p>

    <div class="field">
      <input id="refNumber" type="text" placeholder="Nuevo número" aria-label="Nuevo número de referencia">
    </div>

    <div class="field">
      <label for="methodSelect" style="display:block;margin-bottom:6px;color:#666;font-size:13px;">Cambiar Método de Pago</label>
      <select id="methodSelect" aria-label="Seleccionar método de pago">
        <option>Selecciona una tarjeta</option>
        <option>Tarjeta 1 • **** 1234</option>
        <option>Tarjeta 2 • **** 9876</option>
      </select>
    </div>

    <div class="actions">
      <button id="cancelBtn" class="btn">Cancelar</button>
      <button id="saveBtn" class="btn primary">Guardar</button>
    </div>
  </div>
</div>

<script>
  const backdrop = document.getElementById('backdrop');
  const modal = document.getElementById('modal');
  const closeBtn = document.getElementById('closeModal');
  const cancelBtn = document.getElementById('cancelBtn');
  const saveBtn = document.getElementById('saveBtn');

  const serviceName = document.getElementById('serviceName');
  const providerName = document.getElementById('providerName');
  const refNumber = document.getElementById('refNumber');

  document.querySelectorAll('.card').forEach(card => {
    const sw = card.querySelector('.switch');
    const btn = card.querySelector('.show-info');

    const isOn = sw.classList.contains('on');
    btn.disabled = !isOn;

    sw.setAttribute('aria-checked', String(isOn));
  });

  document.addEventListener('click', (e) => {
    
    const clickedSwitch = e.target.closest('.switch');
    if (clickedSwitch) {
      
      clickedSwitch.classList.toggle('on');
      const state = clickedSwitch.classList.contains('on');
      clickedSwitch.setAttribute('aria-checked', String(state));

      const card = clickedSwitch.closest('.card');
      if (card) {
        const btn = card.querySelector('.show-info');
        if (btn) {
          btn.disabled = !state;
        }
      }
      return; 
    }

    
    const btn = e.target.closest('.show-info');
    if (btn) {
      
      if (btn.disabled) return;
      const card = btn.closest('.card');
      const service = card.getAttribute('data-service') || '—';
      const provider = card.getAttribute('data-provider') || '—';
      openModal({ service, provider });
      return;
    }
  });

  
  document.addEventListener('keydown', (e) => {
    const active = document.activeElement;
    if (active && active.classList && active.classList.contains('switch')) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        active.click(); 
      }
    }
  });

  
  let lastFocusedElement = null;
  function openModal({ service, provider } = {}) {
    serviceName.textContent = service;
    providerName.textContent = provider;
    refNumber.value = ''; 
    backdrop.classList.add('show');
    backdrop.setAttribute('aria-hidden','false');
    
    document.body.style.overflow = 'hidden';
    
    lastFocusedElement = document.activeElement;
    modal.focus();
    document.addEventListener('keydown', handleKeyDown);
  }

  function closeModal() {
    backdrop.classList.remove('show');
    backdrop.setAttribute('aria-hidden','true');
    document.body.style.overflow = '';
    document.removeEventListener('keydown', handleKeyDown);
    if (lastFocusedElement) lastFocusedElement.focus();
  }

  closeBtn.addEventListener('click', closeModal);
  cancelBtn.addEventListener('click', closeModal);
  backdrop.addEventListener('click', (e) => {
    if (e.target === backdrop) closeModal();
  });

  saveBtn.addEventListener('click', () => {
    const newRef = refNumber.value.trim();
    alert('Se guardó referencia: ' + (newRef || '(vacío)'));
    closeModal();
  });

  function handleKeyDown(e) {
    if (e.key === 'Escape') {
      closeModal();
      return;
    }

    if (e.key === 'Tab') {
      const focusables = modal.querySelectorAll('input, button, select, [tabindex]:not([tabindex="-1"])');
      if (focusables.length === 0) return;
      const first = focusables[0];
      const last = focusables[focusables.length - 1];
      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault();
        last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }
  }

  document.querySelectorAll('.show-info').forEach(b => {
    b.addEventListener('mouseenter', () => {
      if (b.disabled) b.style.cursor = 'not-allowed';
    });
    b.addEventListener('mouseleave', () => {
      b.style.cursor = '';
    });
  });
</script>

  <footer>
    <h2>Diseñamos soluciones de vida</h2>
    <p>Acompañándote en cada paso para que sigas avanzando</p>
  </footer>

  <div class="chat">💬 Hola, soy Maya. ¡Chatea conmigo!</div>
</body>
</html>