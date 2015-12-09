<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="index.php">Home</a></li>';
        }
        
        if ($path_parts['filename'] == "tables") {
            print '<li class="activePage">Display Tables</li>';
        } else {
            print '<li><a href="tables.php">Display Tables</a></li>';
        }
         if ($path_parts['filename'] == "addUser") {
            print '<li class="activePage">User Registration</li>';
        } else {
            print '<li><a href="addUser.php">User Registration</a></li>';
        }
         if ($path_parts['filename'] == "mountainReview") {
            print '<li class="activePage">Review a mountain</li>';
        } else {
            print '<li><a href="mountainReview.php">Review a mountain</a></li>';
        }
        
       
        ?>
    </ol>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

