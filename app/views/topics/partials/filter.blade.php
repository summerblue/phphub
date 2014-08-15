<ul class="pull-right list-inline remove-margin-bottom">
	<li>
		<a href="{{ App::make('Topic')->present()->topicFilter('recent') }}">
	    	<i class="glyphicon glyphicon-time"></i> 最近发表 
		</a>
		<span class="divider"></span>
	</li>
	<li>
		<a href="{{ App::make('Topic')->present()->topicFilter('excellent') }}">
			<i class="glyphicon glyphicon-ok"> </i> 精华帖子
		</a>
		<span class="divider"></span>
	</li>
	<li>
		<a href="{{ App::make('Topic')->present()->topicFilter('vote') }}">
			<i class="glyphicon glyphicon-thumbs-up"> </i> 最多投票 
		</a>
		<span class="divider"></span>
	</li>
	<li>
		<a href="{{ App::make('Topic')->present()->topicFilter('noreply') }}">
			<i class="glyphicon glyphicon-eye-open"></i> 无人问津
		</a>
	</li>
</ul>