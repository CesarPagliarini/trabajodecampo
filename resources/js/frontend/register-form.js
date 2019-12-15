
$(document).ready(() => {

        $('#registerButton').click( (e) => {
        e.preventDefault();
        $('#registerForm').addClass('hidden');
        $('#registerLoading').removeClass('hidden');

        const data = {
            'email': $('#registerEmail').val(),
            'password': $('#registerPassword').val(),
            'name': $('#registerName').val(),
        }
        const csrf = $('meta[name="csrf-token"]').attr('content');

        const url = $('#registerUrl').val();
        console.log(url);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf,
            }
        });
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(data){
                window.location.replace(data);
            }
        });

    });
});
