

    if (typeof (Schedule) === 'undefined') ScheduleModule = {};

    ScheduleModule = (function ($) {

        const modu = {
            ProfessionalSettings : {},
        }

        //publishers
        var init = function () {
            $(".specialties_professional_select").select2({width: '100%'});

        };

        //metodos utiles

        var show = function (data) {
            alert(data);
        }

        // suscribers
        var  callApi = function(url, params = {}) {
            const token = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': token}
            });
             $.ajax({
                beforeSend:function() {
                    $('#professional-settings-wrapper').addClass('sk-loading')
                },
                type: "POST",
                url: url,
                data: params,
            }).then((response)=>{
                 ProfessionalSettings = response;
             });
        }
        // expose public methods
        return {
            init: init,
            callApi: callApi,
            show:show,
        };


    })(jQuery);

    jQuery(document).ready(ScheduleModule.init);



