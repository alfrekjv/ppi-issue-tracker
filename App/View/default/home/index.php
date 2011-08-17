<article class="content-box home">
    <?php if($isLoggedIn): ?>
    <div class="" style="position: absolute; top: 12px; right: 20px;">
    <button type="submit"><span class="button green" id="create-ticket-button">Create ticket</span></button>
    </div>
    <?php endif; ?>
    <p class="title">Select a project</p>
    <ul>
    <?php
        if(count($repos) > 0) {
            foreach($repos as $repo) {
                echo "<li><a href='".$baseUrl."ticket/index/filter/cat/". str_replace(' ', '-', $repo["repoName"])."/username/".$repo["user"]."'>".$repo["repoName"]."</a></li>";
            }
        } else {
            echo 'No Categories present.';
        }
    ?>
    </ul>
</article>