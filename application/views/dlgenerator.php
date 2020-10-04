<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view("css") ?>
    <title>  <?=$dosya->isim?> Downloading..</title>
</head>
<body>
<?php $this->load->view("nav") ?><!-- component -->

<div class="w-full mt-10 p-10">
    <?=$dosya->isim?>
    <div class="relative pt-1">
        <div class="flex mb-2 items-center justify-between">
            <div>
      <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
       Downloading..
      </span>
            </div>
            <div class="text-right">
      <span class="text-xs font-semibold inline-block text-blue-600" id="progresstext">
        0%
      </span>
            </div>
        </div>
        <div class="overflow-hidden h-10 mb-4 text-xs flex rounded bg-blue-200">
            <div id="progressbar" style="width:0%"
                 class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition duration-500 ease-in-out"></div>
        </div>
        <span id="generated" class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200 ">

      </span>
    </div>

</div>
<script>
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://www.gdriving.tk/anasayfa/indir/<?=$dosya->id?>', true);

    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.status == 200) {
            if (xhr.readyState == XMLHttpRequest.LOADING) {
                let yuzde = xhr.response.slice(0, -1)
                    .replaceAll('                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', '').trim().slice(0, -1).split("-").pop()
                yuzde = parseFloat(yuzde)
                document.getElementById("progressbar").style.width = yuzde + "%";
                document.getElementById("progresstext").innerText = yuzde + "%";

                console.log(yuzde);
                // this can be also binary or your own content type
                // (Blob and other stuff)
            }
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("progressbar").style.width = "100%";
                document.getElementById("progressbar").style.width = "100%";

                document.getElementById("generated").innerHTML = "<a href='<?php echo base_url() ?>files/<?=$dosya->isim?>'> DOWNLOAD </a>";

            }
        }
    }
</script>
</body>
</html>