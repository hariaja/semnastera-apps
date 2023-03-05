<script>
  @if($message = session('error'))
    Swal.fire({
      icon: 'error',
      title: '{{ $message }}',
      showConfirmButton: 'Ok',
      showConfirmButton: '#2ECC71'
    })
  @endif
</script>