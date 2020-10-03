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
<?php if (tokenvarmi()): ?>
    <div class="transition-all duration-500 ease-in-out w-4/5 bg-white-900 flex items-center justify-center px-5 py-5">

        <div class=" transition-all duration-500 ease-in-out w-full rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-indigo-500 text-white">
            <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">Google Drive İçeriğiniz</h3>
            <h3 class="text-2xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">Klasörler</h3>
            <div class="px-10 grid grid-cols-4 gap-4 m-10">
            <?php foreach($icerik['klasorler'] as $eleman):  ?>
              <div class="px-1 py-1 grid grid-cols-4 gap-4">
                  <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-1 xl:col-span-1 flex flex-col items-center">
                      <a href="<?php echo base_url() ?>anasayfa/gdKlasor/<?=$eleman['id'] ?>">
                      <div class="bg-white shadow-xl rounded-lg -mt-4 w-64">
                          <div class="py-5 px-5">
                              <span class="font-bold text-orange-900 important text-xl"><?=$eleman['adi'] ?></span>
                              <div class="flex items-center justify-between">
                                  <div class="text-xs text-gray-600 font-light">
                                      <?=$eleman['id'] ?>

                                  </div>

                              </div>
                          </div>
                      </div></a>
                  </div>

              </div>
            <?php endforeach; ?>
            </div>
            <h3 class="text-2xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">Dosyalar</h3>
            <div class="px-10 grid grid-cols-3 gap-4 m-10">
                <?php foreach($icerik['dosyalar'] as $eleman):  ?>
                    <div class="px-1 py-1 grid grid-cols-4 gap-4">
                        <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-1 xl:col-span-1 flex flex-col items-center">
                            <a href="<?php echo base_url() ?>anasayfa/gdfile/<?=$eleman['id'] ?>">
                                <div class="bg-white shadow-xl rounded-lg -mt-4 w-64">
                                    <div class="py-5 px-5">
                                        <span class="font-bold text-orange-900 important text-xl"><?=$eleman['adi'] ?></span>
                                        <div class="flex items-center justify-between">
                                            <div class="text-xs text-gray-600 font-light">
                                                <?=$eleman['id'] ?><br>
                                                <?=$eleman['boyut'] ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

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