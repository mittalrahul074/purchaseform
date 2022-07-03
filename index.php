<?php
require './db.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
      <div class="form-group"><h1>Purchase Record 2022-2023</h1></div>
    </div>
    <form class="container" id="sheetdb-form" action="https://sheetdb.io/api/v1/795hf1kupek3l" method="post">
      <input type="hidden" type="text" id="time" name="data[Timestamp]">
      <div class="form-group">
          <label for="cname">COMPANY NAME</label>
          <select class="form-control" id="cname" name="data[COMPANY NAME]">
            <?php
              foreach ($values as $row) {
                // Print columns A and E, which correspond to indices 0 and 4.
                echo "<option value='".$row[1]."'>".$row[1]."</option>";
              }
            ?>
          </select>
      </div>
      <div class="form-group">
        <label for="invoicenumber">INVOICE</label>
        <input type="text" class="form-control" id="invoice" name="data[invoice]" placeholder="Enter invoice number" onkeyup="this.value = this.value.toUpperCase();">
      </div>
      <div class="form-group">
        <label for="date">DATE</label><br>
        <input type="date" name="data[date]" id="date">
      </div>
      <div class="form-group">
        <label for="percentage">Percentage</label>
        <select class="form-control" name="data[Percentage]" id="percentage">
          <option value="0">0</option>
          <option value="3">3</option>
          <option value="12">12</option>
          <option value="18" selected>18</option>
        </select>
      </div>
      <div class="form-group">
        <label for="taxableValue">Taxable Value</label><br>
        <input type="number" name="data[Taxable Value]" id="taxableValue" oninput="totalinvoice(this)">
      </div>
      <div class="form-group">
        <label for="discount">Discount</label><br>
        <input type="number" name="data[Discount]" id="discount" value="0" oninput="totalinvoiceafterdiscount(this)">
      </div>
      <div class="form-group">
        <label for="total">Total</label><br>
        <input type="number" id="total" name="total" readonly>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
  var total;
  var form = document.getElementById('sheetdb-form');
  form.addEventListener("submit", e => {
    e.preventDefault();
    fetch(form.action, {
        method : "POST",
        body: new FormData(document.getElementById("sheetdb-form")),
    }).then(
        response => response.json()
    ).then((html) => {
      // you can put any JS code here
      window.location.href = 'http://localhost/form%201/';
    });
  });

  function totalinvoice(x){
    document.getElementById("time").value=Date.now();
    var tax = document.getElementById("percentage").value;
    var discount = document.getElementById("discount").value;
    total = x.value * tax;
    total = total/100;
    total +=  parseInt(x.value);
    total -= discount;
    document.getElementById("total").value = total;
  }

  function totalinvoiceafterdiscount(x){
    var discount_total = total;
    discount_total -= x.value;
    document.getElementById("total").value = discount_total;
  }
</script>
</html>