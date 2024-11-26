 <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('/')}}assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{asset('/')}}assets/vendor/libs/popper/popper.js"></script>
    <script src="{{asset('/')}}assets/vendor/js/bootstrap.js"></script>
    <script src="{{asset('/')}}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{asset('/')}}assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('/')}}assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{asset('/')}}assets/js/main.js"></script>

    

    {{-- datatable JS --}}
   <script src="{{ asset('/') }}assets/vendor/js/datatable.min.js"></script>

   {{-- moment JS --}}
   <script src="{{ asset('/') }}assets/vendor/js/moment.js"></script>

   {{-- notification --}}
   <script src="{{ asset('/') }}assets/vendor/js/notification.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

   <script src="{{ asset('/') }}assets/vendor/js/jquery.validate.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.validator.addMethod("require_at_least_one", function(value, element, param) {
         const fiveHundred = $('#five_hundred').val();
         const fifty = $('#fifty').val();
         const twenty = $('#twenty').val();
         const ten = $('#ten').val();
         const five = $('#five').val();
         const two = $('#two').val();
         const one = $('#one').val();

         return fiveHundred.trim() !== "" || fifty.trim() !== "" || twenty.trim() !== "" || ten.trim() !== "" || five.trim() !== "" || two.trim() !== "" || one.trim() !== "";
      }, "At least one of these fields must be filled.");

      
    </script>
    
   
