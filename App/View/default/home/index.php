        <article class="content box_1" style="padding: 25px; width: 915px; text-align: left; position: relative;">
        <?php if($isLoggedIn): ?>
        <div class="" style="position: absolute; top: 12px; right: 20px;">
        <button type="submit"><span class="button green" id="create-ticket-button">Create ticket</span></button>
        </div>
        <?php endif; ?>

            <table cellpadding="0" cellpadding="0" class="data" id="ticket_list_table" style="margin-top: 30px;">
                <thead>
                    <tr>
                    <th style="text-align: left;">Select a project</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($repos) > 0): ?>
                    <?php foreach($repos as $repo):?>
                        <tr>
                            <td><a href="<?php echo $baseUrl; ?>ticket/index/filter/cat/<?php echo str_replace(' ', '-', $repo["repoName"]); ?>/username/<?=$repo["user"];?>"><?php echo $repo["repoName"]; ?></a></td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr><td colspan="8" id="no_tickets">No categories present</td></tr>
                <?php endif;?>
                </tbody>
            </table>
        </article>

<script language="javascript">
jQuery(document).ready(function($) {
	$('#ticket_search').submit(function() {
		if(jQuery.trim($('#ticket_keyword').val()) != "") {
			window.location.href = baseUrl + "home/search/keyword/" + $('#ticket_keyword').val();
		}
		return false;
	});

	$('#create-ticket-button').click(function() {
		window.location.href = baseUrl + 'ticket/create';
	});
});
</script>
