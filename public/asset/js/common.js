$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // VALIDASI ADD
    // Submit form when Save changes button is clicked
    $('#saveChangesBtn').click(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Validate form inputs
        var nama = $('#addPesertaForm input[name="nama"]').val();
        var email = $('#addPesertaForm input[name="email"]').val();
        var formIsValid = true;

        // Validate nama
        if (nama.length < 3) {
        $('.errorName').text('Nama must be at least 3 characters long').show();
        formIsValid = false;
        } else {
        $('.errorName').hide();
        }

        // Validate email
        if (!isValidEmail(email)) {
        $('.emailError').text('Invalid email address').show();
        formIsValid = false;
        } else {
        $('.emailError').hide();
        }

        // If form is valid, submit it
        if (formIsValid) {
        $('#addPesertaForm').submit();
        }
    });

  // Function to validate email format
  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
      // name & email validation Edit
    $('.submitBtnEdit').click(function(e) {
        e.preventDefault(); // Menghentikan tindakan bawaan dari tombol submit
    
        var name = $('.namaEdit').val();
        var email = $('.emailEdit').val();
    
        // Validasi nama
        if (name.length < 3) {
          $('.errorName').show();
          return; // Menghentikan eksekusi lebih lanjut jika validasi gagal
        } else {
          $('.errorName').hide();
        }
    
        // Validasi email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          $('.emailError').show();
          return; // Menghentikan eksekusi lebih lanjut jika validasi gagal
        } else {
          $('.emailError').hide();
        }
    
        // Jika kedua validasi berhasil, formulir dapat dikirimkan
        $('#editPesertaModal form').submit();
      });

    // MAX VALUE
	$('#xVal, #yVal, #zVal, #wVal').on('input', function() {
		var maxVal;
		var inputName = $(this).attr('name');
		switch (inputName) {
		case 'xVal':
			maxVal = 33;
			break;
		case 'yVal':
			maxVal = 23;
			break;
		case 'zVal':
			maxVal = 18;
			break;
		case 'wVal':
			maxVal = 13;
			break;
    }
    if ($(this).val() > maxVal) {
		alert('The maximum input value for ' + inputName + ' is ' + maxVal);
		$(this).val('');
		}
    });

    // INFO
	$('a#info').click(function() {
		var id = $(this).data('id');
		var modal = $('#infoPesertaModal').modal('show');

		$.ajax({
			url: '/nilaiPeserta/info/' + id,
			type: 'GET',
			dataType: 'JSON',
			success: function (data) {
				modal.find('.modal-body #infoName').val(data.nama);
				modal.find('.modal-body #infoEmail').val(data.email);
				modal.find('.modal-body #infoIntelegensi').val(data.aspek_intelegensi);
				modal.find('.modal-body #infoNumerical').val(data.aspek_numerical_ability);

				$("#tableInfo td").empty(); // clear any existing values

				var intelegensi = parseInt(data.aspek_intelegensi);
				var numerical = parseInt(data.aspek_numerical_ability);

				// Intelegensi checked symbol
				if (data.aspek_intelegensi === 1 ) {
					$('#intelegensi1').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_intelegensi === 2 ) {
					$('#intelegensi2').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_intelegensi === 3 ) {
					$('#intelegensi3').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_intelegensi === 4 ) {
					$('#intelegensi4').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_intelegensi === 5 ) {
					$('#intelegensi5').html(' &#x2714;').addClass('checkmark');
				}

				// Numerical checked symbol
				if (data.aspek_numerical_ability === 1) {
					$('#numerical1').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_numerical_ability === 2) {
					$('#numerical2').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_numerical_ability === 3) {
					$('#numerical3').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_numerical_ability === 4) {
					$('#numerical4').html(' &#x2714;').addClass('checkmark');
				}
				if (data.aspek_numerical_ability === 5) {
					$('#numerical5').html(' &#x2714;').addClass('checkmark');
				}
			},
			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			}
		});
	});		

    // EDIT
    $('a#edit').click(function(){
        var id = $(this).data('id');
        var modal = $('#editPesertaModal').modal('show');

        $.ajax({
            url: '/nilaiPeserta/' + id + '/edit',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                modal.find('.modal-body #id').val(data.id);
                modal.find('.modal-body #nama').val(data.nama);
                modal.find('.modal-body #email').val(data.email);
                modal.find('.modal-body #xVal').val(data.xVal);
                modal.find('.modal-body #yVal').val(data.yVal);
                modal.find('.modal-body #zVal').val(data.zVal);
                modal.find('.modal-body #wVal').val(data.wVal);
                modal.find('.modal-body #intelegensiVal').val(data.aspek_intelegensi);
                modal.find('.modal-body #numericalVal').val(data.aspek_numerical_ability);
                // Set the action of the form to the updated URL
                // var form = modal.find('#update-user-form');
                // form.attr('action', 'nilaiPeserta/update/' + data.id);
                // form.attr('action', '{{route('nilaiPeserta.update')}}' + data.id);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $('#add').click(function(){
        $('.emailError').hide();
        $('.errorName').hide();
    });


});