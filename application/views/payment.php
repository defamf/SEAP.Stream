<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../third_party/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-lW45ewX5vjtF2jHw-sbo8f01';
Config::$clientKey = 'SB-Mid-client-SV8yDH-kDlDIlaJ6';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
// Config::$isSanitized = true;

// Enable 3D-Secure
// Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// function debugErrorFunc()
// {
//     echo '<script type="text/javascript">';
//     echo 'console.log("asdasd")';
//     echo '</script>';
// }


$snap_token  = $this->input->get('snapToken', TRUE);
$id_transaction = $this->input->get('id_transaction', TRUE);
function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    }
}

?>

<!DOCTYPE html>
<html>
<!-- Favicons -->
<link href="<?= base_url('assets/assets_tiket/'); ?>assets/img/favicon2.png" rel="icon">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/img/apple-touch-icon2.png" rel="apple-touch-icon">
<body style="display: flex;background-color: white; height: 100vh;flex-direction: column;justify-content: center">
<center>
          <h2>Silahkan lanjutkan pembayaran dengan klik tombol dibawah ini</h2>
          <p>Pastikan tiket yang dibeli benar dan sesuai</p>

    <button style=" border: 4px solid #4E9F3D; width: 100px; padding: 5px; color:ghostwhite;
     border-radius: 5px; background-color: #4E9F3D" id="pay-button"  >Bayar Sekarang</button>
</center>
    <!-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {window.location.reload()}
      
        window.onload = function() {
            var id_transaction = 0;
            id_transaction = <?php echo $id_transaction; ?>
            // SnapToken acquired from previous step        
            snap.pay('<?php echo $snap_token ?>', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    window.location.replace('transaksi?status=success&id_transaction=' + id_transaction)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    window.location.replace('transaksi?status=pending&id_transaction=' + id_transaction)

                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    window.location.replace('transaksi?status=error&id_transaction=' + id_transaction)
                }
            });
        };
    </script>
</body>

</html>