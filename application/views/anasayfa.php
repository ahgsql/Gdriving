<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view("css") ?>
    <title>Welcome <?php sezonuseri(); ?></title>
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
                    echo "No Token";
                } ?></span>
        </div>
    </div>

</div>

<?php if (tokenvarmi()): ?>
<div class="flex">

    <div class="transition-all duration-500 ease-in-out w-3/12  bg-white-900 items-center justify-center px-5 py-5">

        <div class=" transition-all duration-500 ease-in-out rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-indigo-500 text-white"
            >
            <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">Authorized,</h3>
            <p class="relative z-10">
                <a href="<?php echo base_url(); ?>anasayfa/gdRoot"
                   class="py-3 px-6 rounded shadow hover:shadow-lg text-white text-lg bg-gray-900 hover:bg-black focus:outline-none transition-all duration-500 ease-in-out">Go to My Drive</a>
            </p>
        </div>
    </div>

    <div class="transition-all duration-500 ease-in-out w-3/12 bg-white-900 items-center justify-center px-5 py-5">
        <div class=" transition-all duration-500 ease-in-out rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-orange-400 text-white">
            <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-3 relative z-10">Caching Settings</h3>
            <h3 class="  text-indigo-100 leading-tight mb-5 relative z-10"> By caching, faster page loads is possible.</h3>
            <p class="relative z-10">
                <a href="<?php echo base_url(); ?>anasayfa/onbellek"
                   class="py-3 px-6 rounded shadow hover:shadow-lg text-white text-lg bg-blue-500 hover:bg-blue-800 focus:outline-none transition-all duration-500 ease-in-out">
                    <?=(onbellekAcik()?"Open Caching":"Close Caching") ?>
                </a>
            </p>
        </div>
    </div>



<?php else: ?>
    <div class="transition-all duration-500 ease-in-out w-3/12 bg-white-900 flex items-center justify-center px-5 py-5">

        <div class=" transition-all duration-500 ease-in-out w-full rounded-lg shadow-xl overflow-hidden relative px-8 pt-16 pb-32 bg-indigo-500 text-white"
             >
            <h3 class="text-3xl font-semibold text-indigo-100 leading-tight mb-10 relative z-10">No Access Token, Click For Generate:</h3>
            <p class="relative z-10">
                <a href="<?php echo base_url(); ?>auth/tokenal"
                   class="py-3 px-6 rounded shadow hover:shadow-lg text-white text-lg bg-gray-900 hover:bg-black focus:outline-none transition-all duration-500 ease-in-out">Get Token
                    </a>
            </p>
        </div>
    </div>

<?php endif; ?>
</div>
</body>
</html>