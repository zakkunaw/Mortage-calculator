<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mortgage Calculator</title>
  <style>
:root{
      --bg: #E4F4FD;          /* latar biru sangat pucat */
      --ink:#4E6E7E;
      --muted:#9AAFBC;

  --badge-blue:#2B6CB0;

      --card:#FEFDFB;         /* card kiri warm white */
      --radius:12px;
      --shadow:0 4px 12px rgba(10,25,35,.06);

      --panel-1:#133E4A;      /* panel kanan hijau gelap */
      --panel-2:#0A2C36;

      --field:#FFFFFF;
      --field-b:#D8E5ED;
      --ring:#7EC8E3;

      --btn:#D8DB2F;          /* tombol kuning lemon */
      --btn-ink:#133E4A;

      --accent:#D8DB2F;       /* angka besar */
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background:var(--bg);
      color:var(--ink);
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      padding:32px;
    }

    /* ===== layout 1:1 ===== */
    .wrap{
      max-width:1120px;
      margin:0 auto;
      display:grid;
      /* make right panel slightly narrower */
      grid-template-columns: 1fr 1fr;   /* left a bit larger, right slightly smaller */
      gap:0;                            /* hilangkan jarak antar card */
      align-items:stretch;              /* tinggi seimbang */
      border-radius:var(--radius);
      overflow:visible; /* izinkan panel menonjol keluar supaya rounded tidak menghasilkan blank space */
      box-shadow:var(--shadow);
    }

    /* ===== card kiri (form) ===== */
    .card{
      background:var(--card);
      border-radius:0;
      box-shadow:none;
      /* reduce right padding slightly now that panel is narrower */
      padding:32px 80px 32px 32px; /* beri ruang kanan untuk area overlap panel */
      display:flex;
      flex-direction:column;
      min-height:520px;
    }
    .title{
      margin:0 0 12px 0;
      font-weight:700;
      font-size:24px;
    }
    /* header row to hold title and clear button */
    #titleRow{display:flex; align-items:center; justify-content:space-between; gap:16px;}
    #clearTitleBtn.link{background:none; border:1px solid transparent; padding:8px 12px; border-radius:8px; color:var(--ink); font-weight:700}
    #clearTitleBtn.link:hover{background:rgba(0,0,0,0.04)}
    form{display:grid; gap:16px;}

    label{
      font-size:14px; 
      color:var(--ink); 
      display:block; 
      margin-bottom:8px;
      font-weight:600;
    }
    .field-inline{
      display:flex; align-items:center; gap:8px;
    }
    .merged-field{display:flex; align-items:center;}
    .merged-field .badge{
      display:inline-flex; align-items:center; justify-content:center;
      height:48px; padding:0 14px; background:#F3F7F6; border:1px solid var(--field-b);
      font-weight:700; color:var(--ink);
    }
    .badge-accent{background:var(--badge-blue); color:#fff; border-color:var(--badge-blue)}
  /* left badge (amount) */
  .merged-left .badge{border-right:0; border-radius:8px 0 0 8px}
  .merged-left input{border-radius:0 8px 8px 0; border-left:0; border-right:1px solid var(--field-b)}
  /* right badge (term) */
  .merged-right input{border-radius:8px 0 0 8px; border-right:0; border-left:1px solid var(--field-b)}
  .merged-right .badge{border-left:0; border-radius:0 8px 8px 0}
  /* make badge-accent flush with input */
  .badge-accent{border-left:0}
    .input-prefix{
      padding:10px 14px; 
      border:1px solid var(--field-b); 
      border-radius:8px; 
      background:#E8F0F5;
      font-weight:700;
      color:var(--ink);
    }

    input[type="number"], input[type="text"], select{
      width:100%;
      height:48px;
      padding:0 14px;
      border:1px solid var(--field-b);
      border-radius:8px;
      background:var(--field);
      font-size:16px;
      font-weight:700;
      color:var(--ink);
      outline:none;
    }
    input:focus, select:focus{
      box-shadow:0 0 0 3px color-mix(in srgb, var(--ring) 35%, transparent);
      border-color:var(--ring);
    }

    .row{display:grid; grid-template-columns: 1fr 1fr; gap:12px;}

    /* radio */
    .radio-col{display:grid; gap:12px;}
    .radio-item{
      display:flex; align-items:center; gap:10px;
      height:48px; padding:0 16px;
      border:1px solid var(--field-b);
      border-radius:8px; 
      background:var(--field); 
      cursor:pointer;
      user-select:none;
      font-weight:700;
      transition: all 0.2s;
    }
/* related resource: latihan2.php:138:5 */
.radio-item input { /* the element was input */
  accent-color: yellow;
  border-color: gray;
}
    /* keep a visible checked appearance but remove any dark/black overlay that was showing */
.radio-item.active{
  background:#FFFCE5;
  border-color:#D8DB2F;
  border-width:2px;
}

/* ensure the native input doesn't introduce a dark overlay when focused/active on some platforms */
.radio-item input{
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width:18px;
  height:18px;
  border:1px solid var(--field-b);
  border-radius:50%;
  display:inline-block;
  margin:0;
  vertical-align:middle;
  background: #fff; /* solid white */
  box-shadow: inset 0 0 0 2px rgba(0,0,0,0.03);
  position:relative;
}

/* checked state: show a colored dot without dark overlay */
.radio-item input:checked::after{
  content: '';
  position: absolute;
  left: 1px;
  top: 1px;
  width:13px;
  height:13px;
  border-radius:50%;
  background: yellow;
  box-shadow: none;
}

/* focus-visible for keyboard users */
.radio-item input:focus-visible{
  outline: 3px solid color-mix(in srgb, var(--ring) 35%, transparent);
  outline-offset: 3px;
}

/* prevent any label :active darkening on touch/press */
.radio-item:active{ background:var(--field); }


    /* actions */
    .actions{display:flex; align-items:center; gap:16px; margin-top:8px}

    .btn{
      height:52px; 
      padding:0 32px; 
      border:none; 
      border-radius:999px;
      background:var(--btn); 
      color:var(--btn-ink); 
      font-weight:700; 
      font-size:16px;
      cursor:pointer;
      box-shadow:0 8px 18px rgba(17,18,6,.10);
      display:inline-flex;
      align-items:center;
      gap:8px;
    }
    .btn:hover{filter:brightness(.96)}
    .btn:active{transform:translateY(1px)}
    .link{
      background:none; 
      border:none; 
      color:var(--ink); 
      cursor:pointer;
      font-size:16px;
    }
    .link:hover{opacity:0.7}

    /* ===== card kanan (hasil) ===== */
    .panel{
      /* buat rounded kiri-bawah lebih besar dan biarkan panel overlap ke kiri
         supaya area rounded diisi oleh warna panel (tidak muncul blank space) */
      border-radius:0 0 0 80px;
      box-shadow:none;
      min-height:520px;
      /* slightly reduce left padding so panel content stays balanced with narrower width */
      padding:20px 40px 32px 72px; /* kurangi padding-top agar heading agak naik */
      background:linear-gradient(180deg, var(--panel-1) 0%, var(--panel-2) 100%);
      color:#EAF7F4;
      display:flex; flex-direction:column; justify-content:center;
      margin-left:-28px; /* geser panel ke kiri sedikit untuk menutup ruang rounded (lebih kecil supaya tidak menutup form) */
      position:relative;
      z-index:1;
    }
  .panel .spacer{flex:1}
  /* move result-box slightly up by making top spacer smaller than bottom */
  .panel .spacer:first-of-type{flex:0.18}
  .panel .spacer:last-of-type{flex:1.82}
    .panel .desc{
      color:rgba(255,255,255,.70); 
      font-size:14px; 
      margin:0 0 32px 0;
      line-height:1.5;
    }

    .result-box{
      background:rgba(0,0,0,.25);
      border-top:4px solid var(--accent);
      border-radius:12px; 
      padding:24px;
      min-height:300px; /* kecilkan agar kotak naik */
      display:flex; flex-direction:column; justify-content:flex-start; align-items:flex-start;
      text-align:left;
      padding-left:20px; padding-right:20px;
      border-top-width:8px;
      margin-left:-12px; /* perpanjang border hampir ke ujung panel */
      width:calc(100% + 12px);
    }

    .result-box .underline{
      background:var(--accent);
      width:calc(100% + 24px); /* extend lebih jauh */
      margin-left:-12px; /* align dengan top border */
      margin-top:20px; /* beri gap lebih besar dari angka */
      border-radius:0.5px;
    }
    .label-sm{
      font-size:14px; 
      color:rgba(255,255,255,.70); 
      margin-bottom:4px;
      margin-top:6px;
      align-self:flex-start;
    }
    .big{
      margin:0 0 2px 0; 
      font-size:56px; 
      line-height:1; 
      font-weight:700; 
      color:var(--accent);
      align-self:flex-start; /* kiri agar consistent */
    }

    .custom-underline {
  border-bottom: 1px solid rgba(255, 255, 255, 0.15);
  margin: 30px auto;
  width: 100%;
}
    .total{
      padding-top:24px;
     
    }
    .total .muted{
      color:rgba(255,255,255,.70); 
      font-size:14px;
      margin-bottom:8px;
    }
    .total .value{
      margin-top:6px; 
      font-weight:700; 
      font-size:24px;
      color:#fff;
    }

    /* ===== responsif ===== */
    @media (max-width: 860px){
      body{padding:20px}
      .wrap{grid-template-columns:1fr; gap:16px; overflow:hidden}
      .card,.panel{min-height:unset}
      .card{padding:20px}
      .panel{margin-left:0; border-radius:0 0 0 12px; padding-left:32px}
      /* ensure title and clear button stack on small screens */
      #titleRow{flex-direction:column; align-items:flex-start}
      #clearTitleBtn.link{align-self:flex-start}
    }
  </style>
</head>
<body>
  <main class="wrap">
    <!-- KIRI -->
    <article class="card">
      <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
        <h2 class="title">Mortgage Calculator</h2>
        <button class="link" type="button" onclick="clearAll()" id="clearTitleBtn">Clear All</button>
      </div>

        <form id="mortgageForm" onsubmit="event.preventDefault(); calculate();">
        <div>
          <label for="amount">Mortgage Amount</label>
          <div class="merged-field merged-left">
            <span class="badge">£</span>
            <input id="amount" type="number" min="0" step="100" value="300000" aria-label="Mortgage amount" />
          </div>
        </div>

        <div class="row">
          <div>
            <label for="term">Mortgage Term</label>
            <div class="merged-field merged-right">
              <input id="term" type="number" min="1" step="1" value="25" aria-label="Mortgage term" />
              <span class="badge">years</span>
            </div>
          </div>

          <div>
            <label for="rate">Interest Rate</label>
            <div class="merged-field merged-right">
              <input id="rate" type="number" step="0.01" min="0" value="5.25" aria-label="Interest rate" />
              <span class="badge badge-accent">%</span>
            </div>
          </div>
        </div>

        <div>
          <label>Mortgage Type</label>
          <div class="radio-col" id="radios">
            <label class="radio-item active"><input type="radio" name="mtype" value="repayment" checked>Repayment</label>
            <label class="radio-item"><input type="radio" name="mtype" value="interest">Interest Only</label>
          </div>
        </div>

        <div class="actions">
          <button class="btn" type="submit">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 7H6C4.89543 7 4 7.89543 4 9V18C4 19.1046 4.89543 20 6 20H15C16.1046 20 17 19.1046 17 18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M9 15H12L20.5 6.5C21.3284 5.67157 21.3284 4.32843 20.5 3.5V3.5C19.6716 2.67157 18.3284 2.67157 17.5 3.5L9 12V15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Calculate Repayments
          </button>
          <!-- Clear All moved to header title area to the right of H2 -->
        </div>
      </form>
    </article>

    <!-- KANAN -->
    <aside class="panel">
      <div class="header">
        <h3 style="margin:0 0 12px 0; font-size:28px; font-weight:700;">Your results</h3>
        <p class="desc">Your results are shown below based on the information you provided. To adjust the results, edit the form and click "calculate repayments" again.</p>
      </div>

      <div class="spacer"></div>

      <div class="result-box" id="results">
        <div class="label-sm">Your monthly repayments</div>
        <p class="big" id="monthly">£1,797.74</p>
        <div class="custom-underline"></div>
        <div class="total">
          <div class="muted">Total you'll repay over the term</div>
          <div class="value" id="total">£539,322.94</div>
        </div>
      </div>

      <div class="spacer"></div>
    </aside>
  </main>

  <script>
    const radios = document.getElementById('radios');
    radios.addEventListener('change', () => {
      [...radios.querySelectorAll('.radio-item')].forEach(l => {
        l.classList.toggle('active', l.querySelector('input').checked);
      });
    });

    function currencyGBP(value){
      return value.toLocaleString('en-GB',{style:'currency',currency:'GBP',maximumFractionDigits:2});
    }
    function calculate(){
      const P = +document.getElementById('amount').value || 0;
      const years = +document.getElementById('term').value || 0;
      const rYear = +document.getElementById('rate').value || 0;
      const months = Math.max(1, Math.round(years*12));
      const r = rYear/100/12;

      const type = document.querySelector('input[name="mtype"]:checked').value;
      let monthly = 0;
      if(type==='interest'){ monthly = P*r; }
      else {
        if(r===0) monthly = P/months;
        else {
          const f = Math.pow(1+r, months);
          monthly = P*r*f/(f-1);
        }
      }
      const total = monthly*months;
      document.getElementById('monthly').textContent = (P&&years)? currencyGBP(monthly): '—';
      document.getElementById('total').textContent   = (P&&years)? currencyGBP(total)  : '—';
    }
    function clearAll(){
      document.getElementById('amount').value='';
      document.getElementById('term').value='';
      document.getElementById('rate').value='';
      document.querySelector('input[value="repayment"]').checked=true;
      radios.dispatchEvent(new Event('change'));
      document.getElementById('monthly').textContent='—';
      document.getElementById('total').textContent='—';
    }
    window.addEventListener('load', calculate);
  </script>
</body>
</html>
