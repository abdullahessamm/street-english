<script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script>
$(document).ready(function(){
    draw();

    function draw() {

        var canvas = document.getElementById('idCanvas');
        var context = canvas.getContext('2d');
        var x = canvas.width / 2;
        var y = canvas.height / 3;
    
        var imageObj = new Image();
        

        imageObj.onload = function() {
            context.drawImage(imageObj, 0, 0);
            context.font = "18px Calibri";
            context.font = "18px Calibri";
            context.textAlign = "center";
            context.fillStyle = "#1E284B";
            context.font = "40px Calibri";
            context.fillText("{{ $publicCertificate->belongsToPublicCertificateLink->certificate_username }}", x, 480);
            context.font = "28px Calibri";
            context.fillText("For Completing {{ $publicCertificate->certificate_name }}", x, 540);
            context.fillText("held on the {{ date('M d, Y', strtotime($publicCertificate->created_at)) }}", x, 580);
            var canvas = document.getElementById('idCanvas');
            var dataURL = canvas.toDataURL();
        }
        imageObj.setAttribute('crossOrigin', 'anonymous');
        imageObj.src = "{{ asset('public/certificates/certificate.png') }}";
        
        download.addEventListener("click", function() {
            // only jpeg is supported by jsPDF
            var pdf = new jsPDF("l", "mm", "a4");
            // var pdf = new jsPDF('p', 'pt', [canvas.width, canvas.height]);
            var pdfWidth = pdf.internal.pageSize.getWidth;
            var pdfHeight = pdf.internal.pageSize.getHeight;
            var imgData = canvas.toDataURL("image/jpeg", 1.0);

            pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
            pdf.save("Street English Academy - {{ $publicCertificate->belongsToPublicCertificateLink->certificate_username }}'s Certificate");
        }, false);
    };

    download.addEventListener("click", function() {
        // only jpeg is supported by jsPDF
        // var pdf = new jsPDF("l", "mm", "a4");
        var pdf = new jsPDF('p', 'px', 'a4');
        var pdfWidth = pdf.internal.pageSize.getWidth;
        var pdfHeight = pdf.internal.pageSize.getHeight;
        var imgData = canvas.toDataURL("image/jpeg", 1.0);

        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
        pdf.save("download.pdf");
    }, false);
});
</script>