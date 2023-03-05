<script>
  let user_active_table

  function cekRoles() {
    var role = '{{ auth()->user()->roles->implode('name') }}'
    if (role == "Administrator") {
      return true;
    } else {
      return false;
    }
  }

  $(function () {
    user_active_table = $('.users-active-table').DataTable({
      processing: true,
      serverSide: true,
      retrieve: true,
      responsive: true,
      autoWidth: false,
      pageLength: 5,
      lengthMenu: [
        [5, 10, 20],
        [5, 10, 20]
      ],
      ajax: {
        url: '{{ route('users.index') }}',
        data: function (d) {
          d.status = $('#status').val()
          d.search = $('input[type="search"]').val()
        }
      },
      columns: [
        {
          "title": "No.",
          "data": "DT_RowIndex",
          "searchable": false, 
          "sortable": false,
          "class": "text-center",
          "width": "10%"
        },
        {
          "name": "first_name",
          "title": "Nama",
          "data": "first_name",
          "class": 'text-center',
          "searchable": true,
          "orderable": true,
        },
        {
          "name": "email",
          "title": "Email",
          "data": "email",
          "class": 'text-center',
          "searchable": false,
          "orderable": false,
        },
        {
          "name": "phone",
          "title": "Telepon",
          "data": "phone",
          "class": 'text-center',
          "searchable": false,
          "orderable": false,
        },
        {
          "name": "roles",
          "title": "Role",
          "data": "roles",
          "class": 'text-center',
          "searchable": false,
          "orderable": false,
        },
        {
          "name": "status",
          "title": "Status",
          "data": "status",
          "class": 'text-center',
          "searchable": false,
          "orderable": false,
        },
        {
          "name": "action",
          "title": '<i class="fa fa-cog"></i>',
          "data": "action",
          "searchable": false, 
          "sortable": false,
          "class": "text-center",
          "width": "15%",
          "visible": cekRoles()
        }
      ],
    })
  })

  $('#status').change(function() {
    user_active_table.draw();
  })

  function deleteUser(url) {
    Swal.fire({
      icon: 'warning',
      title: "Apakah Anda Yakin?",
      html: "Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!",
      showCancelButton: true,
      confirmButtonText: 'Hapus Data',
      cancelButtonText: 'Batalkan',
      cancelButtonColor: '#E74C3C',
      confirmButtonColor: '#3498DB'
    }).then((result) => {
      if (result.value) {
        $.post(url, {
          '_token': $('[name=csrf-token]').attr('content'),
          '_method': 'delete'
        })
        .done((response) => {
          Swal.fire({
            icon: 'success',
            title: response.message,
            confirmButtonText: 'Selesai'
          })
          user_active_table.ajax.reload()
        })
        .fail((errors) => {
          Swal.fire({
            icon: 'error',
            title: errors.responseJSON.message,
            confirmButtonText: 'Mengerti'
          })
          return
        })
      } else if (result.dismiss == swal.DismissReason.cancel) {
        Swal.fire({
          icon: 'error',
          title: 'Dibatalkan',
          text: 'Tidak ada perubahan disimpan',
          showConfirmButton: 'Ok',
          customClass: {
            confirmButton: 'btn btn-indigo',
          }
        })
      }
    })
  }
</script>