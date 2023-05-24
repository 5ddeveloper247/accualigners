
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Rajdhani:wght@300;400;500;600;700&display=swap');
    body{
        font-family: Rajdhani, Sans-Serif;
    }
</style>
<body>

<div class="max-w-7xl mx-auto lg:py-5 px-4">
    <div class="grid grid-cols-12 gap-x-8">
        <div class="col-span-12">
            <img class="lg:max-w-[300px] max-w-[240px] pt-3 pb-8" src="rsz_11png.png">
            <h2 class="text-[30px] font-[700]"><b>Is Accualigner right for you or your loved one?</b></h2>
            <p class="text-[18px] font-[500]">Smiles come in all shapes and sizes, and so do malocclusions. Accualigners can straighten a wide variety of smiles. If any of these look like your teeth or the teeth of your loved one and you are interested in Accualigners, get in touch with us!</p>
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">CROWDING</h2>
    		<img src="Crowding_Tile1.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">SPACING</h2>
    		<img src="Spacing_Tile2.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">DEEP BITE</h2>
    		<img src="DeepBite_Tile3.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">OVER JET</h2>
    		<img src="Overjet_Tile4.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">CROSS BITE</h2>
    		<img src="Crossbite_Tile5.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">OPEN BITE</h2>
    		<img src="OpenBite_Tile6.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">MIDLINE SHIFT</h2>
    		<img src="MidlineShift_Icon.png" class="w-full">
        </div>
        <div class="lg:col-span-3 md:col-span-6 col-span-12">
    		<h2 class="text-[#0eb7de] text-[28px] font-[700] mt-3">EDGE TO EDGE</h2>
    		<img src="CC_EdgetoEdgeIconV2.png" class="w-full">
        </div>
    </div>
    <div class="grid grid-cols-12 items-center mt-4 mb-10">
        <div class="col-span-12">
            <form id="myForm" class="w-full mt-4 block" method="get" >
                <input class="rounded-[8px] h-[50px] w-full bg-[#F5f5f5] mb-4 border-[1px] border-[#e2e2e2] px-4" placeholder="Enter Full Name" id="name" name="name" type="text" required>
                <input class="rounded-[8px] h-[50px] w-full bg-[#F5f5f5] mb-4 border-[1px] border-[#e2e2e2] px-4" placeholder="Enter Email Address" id="email" name="email" type="email" required>
                <input class="rounded-[8px] h-[50px] w-full bg-[#F5f5f5] mb-4 border-[1px] border-[#e2e2e2] px-4" placeholder="Enter Password" id="password" name="password" type="password" required>
                <input class="rounded-[8px] h-[50px] w-full bg-[#F5f5f5] mb-4 border-[1px] border-[#e2e2e2] px-4" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" type="password" required>
                <button class="lg:px-12 mt-4 h-[50px] bg-[#0eb7de] text-[#fff] font-[700] block min-w-[200px] rounded-[8px] uppercase font-[700] text-[24px]" type="submit">Submit</button>
            </form>
            
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
$(document).ready(function(){
        $('#myForm').on('submit', function (e) {
            e.preventDefault();
            
            
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var passwword = document.getElementById('password').value;
            var password_confirmation = document.getElementById('password_confirmation').value;
            $.ajax({
                url: "https://accualigners.app/admin/patient-signup?name=" + name + "&email=" + email + "&password=" + passwword + "&password_confirmation=" + password_confirmation,
                type: 'GET',
            }).done(function (data) {
                toastr.success(JSON.stringify(data['message']));
            }).fail(function (data) {
                toastr.error(JSON.stringify(data['message']));
            });
            
        });
    })
</script>
</body>
</html>