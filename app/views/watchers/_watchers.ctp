<?php echo $this->renderElement('watchers/watchers', array(
    'list'=>!empty($data['Watcher'])?$data['Watcher']:array(), 
    'object_type'=>$objectType, 
    'watched'=>$objectId, 
    'members'=>$members,
    'addIssueWatchersAllowed'=>$candy->authorize_for(':add_issue_watchers')
    ), 'Watchers'); ?>
