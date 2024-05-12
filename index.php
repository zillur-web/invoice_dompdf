
<?php

$path = 'invoice-header-aa90d9aa-4e03-433a-8b9e-0840aa2ce634.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $html = '

    <html>
    <head>
    <style>'.file_get_contents("bootstrap.css") .'</style>   
     <style>
        @page { margin: 140px 0px; }
        #header { position: fixed; left: 0px; top: -140px; right: 0px; height: 150px;  text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -190px; right: 0px; height: 150px; }
        #content {margin: 10px 30px;}

        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }
        
        .table > tbody > tr > .no-line {
            border-top: none;
        }
        
        .table > thead > tr > .no-line {
            border-bottom: none;
        }
        
        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
        
      </style>
    <body>
      <div id="header">
        <img style="width: 100%;" src="'.$base64.'" alt="">
      </div>
      <div id="footer">
      <img style="width: 100%;" src="'.$base64.'" alt="">
      </div>
      <div id="content">
      <div class="row">
      <div class="col-xs-12">
      <div class="invoice-title">
        <h2>Invoice</h2><h3 class="pull-right">Order # 12345</h3>
      </div>
      <hr>
      <div class="row">
        <div class="col-xs-6">
          <address>
          <strong>Billed To:</strong><br>
            John Smith<br>
            1234 Main<br>
            Apt. 4B<br>
            Springfield, ST 54321
          </address>
        </div>
        <div class="col-xs-6 text-right">
          <address>
            <strong>Shipped To:</strong><br>
            Jane Smith<br>
            1234 Main<br>
            Apt. 4B<br>
            Springfield, ST 54321
          </address>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <address>
            <strong>Payment Method:</strong><br>
            Visa ending **** 4242<br>
            jsmith@email.com
          </address>
        </div>
        <div class="col-xs-6 text-right">
          <address>
            <strong>Order Date:</strong><br>
            March 7, 2014<br><br>
          </address>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Order summary</strong></h3>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-condensed">
              <thead>
                              <tr>
                    <td><strong>Item</strong></td>
                    <td class="text-center"><strong>Price</strong></td>
                    <td class="text-center"><strong>Quantity</strong></td>
                    <td class="text-right"><strong>Totals</strong></td>
                              </tr>
              </thead>
              <tbody>
                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                <tr>
                  <td>BS-200</td>
                  <td class="text-center">$10.99</td>
                  <td class="text-center">1</td>
                  <td class="text-right">$10.99</td>
                </tr>
                              <tr>
                    <td>BS-400</td>
                  <td class="text-center">$20.00</td>
                  <td class="text-center">3</td>
                  <td class="text-right">$60.00</td>
                </tr>
                              <tr>
                      <td>BS-1000</td>
                  <td class="text-center">$600.00</td>
                  <td class="text-center">1</td>
                  <td class="text-right">$600.00</td>
                </tr>
                <tr>
                  <td class="thick-line"></td>
                  <td class="thick-line"></td>
                  <td class="thick-line text-center"><strong>Subtotal</strong></td>
                  <td class="thick-line text-right">$670.99</td>
                </tr>
                <tr>
                  <td class="no-line"></td>
                  <td class="no-line"></td>
                  <td class="no-line text-center"><strong>Shipping</strong></td>
                  <td class="no-line text-right">$15</td>
                </tr>
                <tr>
                  <td class="no-line"></td>
                  <td class="no-line"></td>
                  <td class="no-line text-center"><strong>Total</strong></td>
                  <td class="no-line text-right">$685.99</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
        
      </div>
    </body>
  </html>
  
    ';

    require 'vendor/autoload.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

   $dompdf->loadHtml($html);

    // Render PDF (optional: save to file or output to browser)
    $dompdf->render();
    $dompdf->stream("document.pdf", array("Attachment" => false));
?>


