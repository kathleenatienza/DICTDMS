<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="src/js/try.js"></script>
<?php
if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
   ?>
<script>
      Swal.fire({
      title: "<?php echo $_SESSION ['status']; ?>",
      icon: "<?php echo $_SESSION ['status_code']; ?>",
      text: 'Thank you for sending a request. Please wait to evaluate your request by the shelter.',
      footer: 'Have a Good Day and God Bless!',
      button: "OK Done!",
      });
</script>
   <?php
unset ($_SESSION['status']);
}
?>

</script>

<script type="text/javascript">
$(function(){
    var requiredCheckboxes = $('.browsers :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});
</script>

<script type="text/javascript">
$(function(){
    var requiredCheckboxes = $('.browsers1 :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});
</script>

<script type="text/javascript">
$(function(){
    var requiredCheckboxes = $('.browsers2 :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});
</script>

<script type="text/javascript">
$(function(){
    var requiredCheckboxes = $('.browsers3 :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});
</script>

<script type="text/javascript">
$('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
});
</script>
<script src="https://www.google.com/recaptcha/api.js?render=6LdxnEAdAAAAAFFg4beIeOfj1hRRhmgjnRDL6CcH"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script type="text/javascript">
         $(document).ready(function(){
            setInterval(function(){
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdxnEAdAAAAAFFg4beIeOfj1hRRhmgjnRDL6CcH', {action: 'application_form'}).then(function(token) {
                    $('#token').val(token);
                    $('#action').val('application_form');
                });
            });
            }, 3000);
         });

      </script>