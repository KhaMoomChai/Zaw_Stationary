<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Div with Image</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #myDiv {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div id="myDiv" class="col-md-6">
                    <center>
                        <img src="temp/Tombow$2.png" alt="Your Image" class="img-fluid"><br>
                        <span><b>Code No:</b>123456789</span>
                    </center>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <button class="btn btn-primary" onclick="printDiv('myDiv')">Print Div</button>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <script>
        function printDiv(divId) {
            var divToPrint = document.getElementById(divId);
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></head><body>' + divToPrint.innerHTML + '</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

</body>
</html>
