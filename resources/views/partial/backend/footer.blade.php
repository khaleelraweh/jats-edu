<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6" id="copyright">
                <!-- The copyright year will be inserted here -->
            </div>

            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                </div>
            </div>
        </div>
    </div>
</footer>


<script>
    // Find the div element by its ID
    var copyrightDiv = document.getElementById('copyright');

    // Create a new text node with the current year
    var currentYear = new Date().getFullYear();
    var yearTextNode = document.createTextNode(currentYear);

    // Append the text node to the div element
    copyrightDiv.appendChild(yearTextNode);

    // Add the text "© Upcube." after the year
    var upcubeText = document.createTextNode(' © Upcube.');
    copyrightDiv.appendChild(upcubeText);
</script>
