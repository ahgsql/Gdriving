
<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view("css")  ?>
    <title>Document</title>
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div>
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                Giriş Yapın
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600">
                ya da
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                   kayıt olun
                </a>
            </p>
        </div>
        <form class="mt-8" action="<?php echo base_url(); ?>login/girdir" method="POST">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm">
                <div>
                    <input aria-label="Kullanıcı Adı" name="kadi" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="Kullanıcı Adı">
                </div>
                <div class="-mt-px">
                    <input aria-label="Password" name="sifre" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="Şifre">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                       Beni Hatırla
                    </label>
                </div>

                <div class="text-sm leading-5">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                       Şifrenizi mi Unuttunuz?
                    </a>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">

                  Giriş Yap
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>