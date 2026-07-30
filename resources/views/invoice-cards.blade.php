<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Total Invoices Cards</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background-color: #171a30; /* dark dashboard background, sesuaikan kalau perlu */
    padding: 40px;
  }

  .invoice-card {
    border-radius: 14px;
    padding: 28px 24px;
    color: #ffffff;
    min-height: 140px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  }

  .invoice-card .label {
    font-size: 0.95rem;
    opacity: 0.9;
    margin-bottom: 6px;
  }

  .invoice-card .value {
    font-size: 2rem;
    font-weight: 700;
  }

  /* card 1: ungu -> biru */
  .card-purple {
    background: linear-gradient(135deg, #8f3ef0 0%, #6c63ff 100%);
  }

  /* card 2: salmon -> pink */
  .card-pink {
    background: linear-gradient(135deg, #ff8a8a 0%, #ef2f6a 100%);
  }

  /* card 3: kuning -> oranye */
  .card-orange {
    background: linear-gradient(135deg, #ffc267 0%, #ff7a1a 100%);
  }

  /* card 4: biru -> indigo */
  .card-blue {
    background: linear-gradient(135deg, #4a3bf3 0%, #7c8bff 100%);
  }
</style>
</head>
<body>

<div class="container-fluid">
  <div class="row g-4">
    <div class="col-md-3 col-sm-6">
      <div class="invoice-card card-purple">
        <div class="label">Total invoices</div>
        <div class="value">28893</div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="invoice-card card-pink">
        <div class="label">Total invoices</div>
        <div class="value">28893</div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="invoice-card card-orange">
        <div class="label">Total invoices</div>
        <div class="value">28893</div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="invoice-card card-blue">
        <div class="label">Total invoices</div>
        <div class="value">28893</div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
