<footer style="background-color: #e3f2fd;">
            <div class="container">
                Twitter Clone &copy; <?=date('Y')?>
            </div>            
        </footer>
    </div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <?php echo script_tag('/asset/js/komen.js');?>
 <?php echo script_tag('/asset/js/reply.js');?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Bootstrap components
        var myModal = new bootstrap.Modal(document.getElementById('likeModal{{ $tweet->id }}'));
    });
</script>

</body>

</html>
