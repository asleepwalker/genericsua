<? if (count($pagination['buttons'])) { ?>
	<ul class="pagination">
		<? if ($pagination['current'] > 1) { ?>
			<li class="prev"><a href="?q=<?= $_GET['q'] ?>&p=<?= $pagination['current'] - 1 ?>">«</a></li>
		<? } else { ?>
			<li class="prev"><span>«</span></li>
		<? } ?>
		<? foreach ($pagination['buttons'] as $page) { ?>
			<? if ($page != $pagination['current']) { ?>
				<li><a href="?q=<?= $_GET['q'] ?>&p=<?= $page ?>"><?= $page ?></a></li>
			<? } else { ?>
				<li class="active"><span class="active"><?= $page ?></span></li>
			<? } ?>
		<? } ?>
		<? if ($pagination['current'] < $pagination['total']) { ?>
			<li class="next"><a href="?q=<?= $_GET['q'] ?>&p=<?= $pagination['current'] + 1 ?>">»</a></li>
		<? } else { ?>
			<li class="next"><span>»</span></li>
		<? } ?>
	</ul>
<? } ?>