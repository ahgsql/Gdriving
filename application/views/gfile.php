<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view("css") ?>
    <title>Drive'na Hoşgeldin <?php sezonuseri(); ?></title>
</head>
<body>
<?php $this->load->view("nav") ?><!-- component -->
<div class="-m-2 text-center mt-10">

    <div class="p-2">
        <div class="inline-flex items-center bg-white leading-none text-purple-600 rounded-full p-2 shadow text-sm">
            <span class="inline-flex bg-purple-600 text-white rounded-full h-6 px-3 justify-center items-center text-">TOKEN</span>
            <span class="inline-flex px-2"><?php if (tokenvarmi()) {
                    echo json_decode(ben()->token)->access_token;
                } else {
                    echo "TOKEN YOK";
                } ?></span>
        </div>
    </div>

</div>
<?php if (tokenvarmi()):  ?>
    <div class="transition-all duration-500 ease-in-out w-4/5 bg-white-900 flex items-center justify-center px-5 py-5">
        <div class=" transition-all duration-500 ease-in-out w-full rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-indigo-500 text-white">
            <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10"> <?=$icerik->isim ?></h3>
            <h3 class="text-xl font-semibold text-indigo-100 leading-tight mb-3 relative z-10">Tür: <?=$icerik->tur ?></h3>
            <h3 class="text-xl font-semibold text-indigo-100 leading-tight mb-3 relative z-10">Dosya Boyutu: <?=boyutDon($icerik->boyut) ?></h3>
            <h3 class="text-xl font-semibold text-indigo-100 leading-tight mb-3 relative z-10">İndirme Linki:
                <a class="underline"  href="<?=$icerik->indirmelinki ?>"><?=$icerik->indirmelinki ?></a></h3><br>
            <a href="<?=base_url()?>anasayfa/dlgenerator/<?=$icerik->id ?>" class="bg-red-500 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 hover:border-t-2 border-red-900 hover:border-red-600 rounded">
                Direkt Link Oluştur
            </a>
        </div>
    </div>

<?php else: ?>
    <div class="transition-all duration-500 ease-in-out min-w-screen min-h-screen bg-white-900 flex items-center justify-center px-5 py-5">

        <div class=" transition-all duration-500 ease-in-out w-full rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-indigo-500 text-white"
             style="max-width:400px;">
            <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">Access Token
                Bulunamadı, almak için tıklayın:</h3>
            <p class="relative z-10">
                <a href="<?php echo base_url(); ?>auth/tokenal"
                   class="py-3 px-6 rounded shadow hover:shadow-lg text-white text-lg bg-gray-900 hover:bg-black focus:outline-none transition-all duration-500 ease-in-out">Token
                    Al</a>
            </p>
        </div>
    </div>
<?php endif; ?>
</body>
</html>