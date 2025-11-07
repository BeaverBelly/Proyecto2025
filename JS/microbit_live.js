// Endpoint PHP que devuelve JSON { items: [{ timestamp, value }, ...] }
const ENDPOINT = "PHP/microbit_latest.php";  // nombre del PHP
const INTERVAL_MS = 2000;   // frecuencia de actualización
const MAX_POINTS  = 100;    // puntos en gráfico de línea
const MAX_ROWS    = 20;     // filas en tabla

let charts = { line: null, bar: null, pie: null };

// ---------- Helpers de fecha/etiquetas ----------
function toDate(ts) {
  if (typeof ts === "number") return new Date(ts);
  const n = Number(ts);
  if (!Number.isNaN(n) && ts !== "" && ts !== null) return new Date(n);
  return new Date(ts);
}

function fmtTime(ts) {
  const d = toDate(ts);
  const p = n => String(n).padStart(2, "0");
  return `${p(d.getHours())}:${p(d.getMinutes())}:${p(d.getSeconds())}`;
}

function fmtLabel(ts) {
  // Si es solo fecha YYYY-MM-DD, se muestra tal cual
  const s = String(ts);
  if (/^\d{4}-\d{2}-\d{2}$/.test(s)) return s;
  // Si viene con hora → 'MM-DD HH:MM'
  const d = toDate(ts);
  const p = n => String(n).padStart(2, "0");
  return `${p(d.getMonth() + 1)}-${p(d.getDate())} ${p(d.getHours())}:${p(d.getMinutes())}`;
}

// ---------- Inicialización de gráficos ----------
function initCharts() {
  const ctxLine = document.getElementById("chartLine");
  const ctxBar  = document.getElementById("chartBar");
  const ctxPie  = document.getElementById("chartPie");

  if (ctxLine) {
    charts.line = new Chart(ctxLine, {
      type: "line",
      data: {
        labels: [],
        datasets: [{ label: "Lectura", data: [], tension: 0.2, pointRadius: 2 }]
      },
      options: {
        responsive: true,
        animation: false,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
      }
    });
  }

  if (ctxBar) {
    charts.bar = new Chart(ctxBar, {
      type: "bar",
      data: {
        labels: [],
        datasets: [{ label: "Últimas lecturas", data: [] }]
      },
      options: {
        responsive: true,
        animation: false,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
      }
    });
  }

  if (ctxPie) {
    charts.pie = new Chart(ctxPie, {
      type: "doughnut",
      data: {
        // Se sobreescriben en updatePieFrom
        labels: ["Bajo", "Medio", "Alto"],
        datasets: [{ data: [0, 0, 0] }]
      },
      options: {
        responsive: true,
        animation: false,
        plugins: {
          tooltip: {
            callbacks: {
              label(ctx) {
                const count = ctx.parsed;
                const dataset = ctx.chart.data.datasets[0].data;
                const total = dataset.reduce((a,b)=>a+b,0) || 1;
                const perc = Math.round((count * 100) / total);
                return `${ctx.label} • ${perc}% (${count})`;
              }
            }
          }
        }
      }
    });
  }
}

// ---------- Donut: recalcular desde cero + etiquetas claras ----------
function updatePieFrom(items) {
  // Umbrales ajustados a tu rango (~1.5–3.1 °C)
  const counts = [0, 0, 0]; // [Bajo, Medio, Alto]
  items.forEach(({ value }) => {
    const v = Number(value);
    if (v < 2.0) counts[0]++;        // Bajo
    else if (v < 2.5) counts[1]++;   // Medio
    else counts[2]++;                // Alto
  });

  const total = counts.reduce((a,b)=>a+b,0) || 1;
  const pct = counts.map(c => Math.round((c * 100) / total));

  charts.pie.data.labels = [
    `Bajo (< 2.0°C) — ${pct[0]}% (${counts[0]})`,
    `Medio (2.0–2.5°C) — ${pct[1]}% (${counts[1]})`,
    `Alto (≥ 2.5°C) — ${pct[2]}% (${counts[2]})`
  ];
  charts.pie.data.datasets[0].data = counts;
  charts.pie.update();
}

// ---------- Render completo (sin duplicar) ----------
function renderAll(items) {
  // Ordená por fecha por si el CSV no viene ordenado
  const sorted = [...items].sort((a, b) => toDate(a.timestamp) - toDate(b.timestamp));
  const labels = sorted.map(it => fmtLabel(it.timestamp));
  const values = sorted.map(it => Number(it.value));

  // Línea: últimos MAX_POINTS
  if (charts.line) {
    charts.line.data.labels = labels.slice(-MAX_POINTS);
    charts.line.data.datasets[0].data = values.slice(-MAX_POINTS);
    charts.line.update();
  }

  // Barras: últimas 10
  if (charts.bar) {
    charts.bar.data.labels = labels.slice(-10);
    charts.bar.data.datasets[0].data = values.slice(-10);
    charts.bar.update();
  }

  // Donut
  if (charts.pie) {
    updatePieFrom(sorted);
  }

  // Tabla: últimas MAX_ROWS (más recientes arriba)
  const tbody = document.querySelector("#tablaLecturas tbody");
  if (tbody) {
    tbody.innerHTML = "";
    const last = sorted.slice(-MAX_ROWS).reverse();
    last.forEach(({ timestamp, value }) => {
      const tr = document.createElement("tr");
      tr.innerHTML = `<td>${fmtLabel(timestamp)}</td><td>${Number(value)}</td>`;
      tbody.appendChild(tr);
    });
  }
}

// ---------- Fetch + loop ----------
async function fetchLatest() {
  const s1 = document.getElementById("statusLine");
  const s2 = document.getElementById("statusBar");
  const s3 = document.getElementById("statusPie");

  try {
    const res = await fetch(ENDPOINT, { cache: "no-store" });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    const data = await res.json();

    const items = Array.isArray(data) ? data
                : Array.isArray(data.items) ? data.items
                : [data];

    if (!items || !items.length) {
      ["statusLine","statusBar","statusPie"].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = "Sin datos";
      });
      return;
    }

    renderAll(items);

    const now = fmtTime(Date.now());
    if (s1) s1.textContent = `Actualizado: ${now}`;
    if (s2) s2.textContent = `Actualizado: ${now}`;
    if (s3) s3.textContent = `Actualizado: ${now}`;

  } catch (err) {
    console.error("Error Micro:Bit", err);
    ["statusLine","statusBar","statusPie"].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.textContent = "Error al actualizar. Reintentando…";
    });
  }
}

function start() {
  initCharts();
  fetchLatest();
  setInterval(fetchLatest, INTERVAL_MS);
}

document.addEventListener("DOMContentLoaded", start);
