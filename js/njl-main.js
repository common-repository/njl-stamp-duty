class njl_sd {




    calculate(num) {

        num = parseInt(num);


        if (isNaN(num)) {
            return 0;
        }


        num = Math.floor(num);

        var taxes = [];
        var total = 0;
        var cur = 0;
        if (num <= 500000) {
            return 0;
        }

        if (num > 500000) {

            cur = Math.min(num, 925000) - 500000;
            cur = cur * 0.05;
            total = total + cur;
            taxes.push(cur);
        }

        if (num > 925000) {
            cur = Math.min(num, 1500000) - 925000;
            cur = cur * 0.1;
            total = total + cur;
            taxes.push(cur);
        }

        if (num > 1500000) {
            cur = num - 1500000;
            cur = cur * 0.12;
            total = total + cur;
            taxes.push(cur);
        }

        total = Math.floor(total);
        return total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");



    }

    calculate_first_time(num) {
       //same as normal now
      
       return (this.calculate(num));

    }

    calculate_second(num) {

        num = parseInt(num);

        if (isNaN(num)) {
            return 0;
        }

        if (num < 40000) {
            return 0;
        }

        num = Math.floor(num);

        var taxes = [];
        var total = 0;
        var cur = 0;

        cur = Math.min(num, 500000);
        cur = cur * 0.03;
        total = total + cur;
        taxes.push(cur);

      
        if (num > 500000) {
            cur = Math.min(num, 925000) - 500000;
           
            cur = cur * 0.08;
            total = total + cur;
            taxes.push(cur);
        }

        if (num > 925000) {
            cur = Math.min(num, 1500000) - 925000;
            cur = cur * 0.13;
            total = total + cur;
            taxes.push(cur);
        }

        if (num > 1500000) {
            cur = num - 1500000;
            cur = cur * 0.15;
            total = total + cur;
            taxes.push(cur);
        }

        total = Math.floor(total);
        return total;

    }

}



(function($) {

    function sd_get_taxes() {
        var calulator = new njl_sd();
        var input = $("#house-price").val();
        input = input.split(",").join("")

        var total;
        if ($('#njl-btn-fp.active').length) {
            total = calulator.calculate(input);
        } else if ($('#njl-btn-ap.active').length) {
            total = calulator.calculate_second(input);
        } else if ($('#njl-btn-ftb.active').length) {          
            total = calulator.calculate_first_time(input);            
        }

        total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        total = "Stamp Duty " + "&pound;" + total;
        $("#njl-sd-results-container").html(total);
        $('#njl-sd-results-container').show(500);
    }

    $(document).on('click', '.njl-sd-ul li', function() {  
        event.preventDefault();
       
        $("#njl-btn-fp").removeClass('active');
        $("#njl-btn-ap").removeClass('active');
        $("#njl-btn-ftb").removeClass('active');

        $(this).children('a').addClass('active');
        sd_get_taxes();

    });





    $(document).on('click', '#njl-sd-btn', function(e) {
        sd_get_taxes();
    });

    $(document).on('keyup', '#house-price', function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });


})(jQuery);