<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view("css") ?>
    <title>Linkleriniz <?php sezonuseri(); ?></title>
</head>
<body>
<?php $this->load->view("nav") ?><!-- component -->

<div class="transition-all duration-500 ease-in-out w-4/5 bg-white-900 flex items-center justify-center px-5 py-5">

    <div class=" transition-all duration-500 ease-in-out w-full rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-indigo-500 text-white">
        <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">Linkleriniz</h3>
        <div class="px-10 grid grid-cols-3 gap-4 m-10">
               <?php foreach( linkler() as $link): ?>
                   <div class="px-1 py-1 grid grid-cols-3 gap-3">
                       <div class="col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-1 xl:col-span-1 flex flex-col items-center">
                           <a href="<?php echo base_url() ?><?php echo $link->directlink ?>">
                               <div class="bg-white shadow-xl rounded-lg -mt-4 w-64">
                                   <div class="py-5 px-5">
                                       <span class="font-bold text-orange-900 important text-xl"><?php echo  $link->dosyaAdi ?></span>
                                   </div>
                               </div>
                           </a>
                       </div>
                   </div>
        <?php endforeach; ?>
        </div>
    </div>

</div>
</body>
</html>