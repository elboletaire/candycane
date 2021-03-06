<table class="list time-entries">
<thead>
<tr>
  <?php echo $sort->sort_header_tag('TimeEntry.spent_on', array('caption'=>__('Date',true), 'url'=>$timelog->url_options($main_project, $issue))); ?>
  <?php echo $sort->sort_header_tag('TimeEntry.user_id', array('caption'=>__('Member',true), 'url'=>$timelog->url_options($main_project, $issue))); ?>
  <?php echo $sort->sort_header_tag('TimeEntry.activity_id', array('caption'=>__('Activity',true), 'url'=>$timelog->url_options($main_project, $issue))); ?>
  <?php echo $sort->sort_header_tag('Project.name', array('caption'=>__('Project',true), 'url'=>$timelog->url_options($main_project, $issue))); ?>
  <?php echo $sort->sort_header_tag('TimeEntry.issue_id', array('caption'=>__('Issue',true), 'url'=>$timelog->url_options($main_project, $issue))); ?>
  <th><?php __('Comment') ?></th>
  <?php echo $sort->sort_header_tag('TimeEntry.hours', array('caption'=>__('Hours',true), 'url'=>$timelog->url_options($main_project, $issue))); ?>
  <th></th>
</tr>
</thead>
<tbody>
<?php foreach($entries as $entry) : ?>
  <tr class="time-entry <?php echo $candy->cycle(); ?>">
    <td class="spent_on"><?php echo $candy->format_date($entry['TimeEntry']['spent_on']); ?></td>
    <td class="user"><?php echo h($candy->format_username($entry['User'])); ?></td>
    <td class="activity"><?php echo h($entry['Activity']['name']); ?></td>
    <td class="project"><?php echo h($entry['Project']['name']); ?></td>
    <td class="subject">
    <?php 
      if(!empty($entry['Issue']['tracker_id'])) {
        $entry['Tracker'] = array('name'=>$trackers[$entry['Issue']['tracker_id']]);
        echo $candy->link_to_issue($entry).': '.h($candy->truncate($entry['Issue']['subject'], 50));
      }
    ?>
    </td>
    <td class="comments"><?php echo h($entry['TimeEntry']['comments']); ?></td>
    <td class="hours"><?php echo $candy->html_hours(sprintf("%.2f",$entry['TimeEntry']['hours'])); ?></td>
    <td align="center">
    <?php if($candy->authorize_for('edit_own_time_entries', $entry)): ?>
        <?php echo $html->link($html->image('edit.png'),   array('controller' => 'timelog', 'action' => 'edit',    'id' => $entry['TimeEntry']['id']), array('title' => __('Edit',true)), false, false); ?>
        <?php echo $html->link($html->image('delete.png'), array('controller' => 'timelog', 'action' => 'destroy', 'id' => $entry['TimeEntry']['id']), array('title' => __('Delete',true), 'method' => 'post'), __('Are you sure ?',true), false); ?>
    <?php endif; ?>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
