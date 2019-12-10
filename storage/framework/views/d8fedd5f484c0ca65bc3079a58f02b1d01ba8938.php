<?php $__env->startSection('content'); ?>
<div class="container-fluid app-body settings-page">
	<div class="panel panel-default">
        <div class="panel-heading">
            <h3>Recent posts send to buffer</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo e(url("history")); ?>" method="get">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <input type="text" name="search" value="<?php echo e(request()->input('search')); ?>" class="form-control" placeholder="search">
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="text" name="date" value="<?php echo e(request()->input('date')); ?>" class="form-control" placeholder="date">
                    </div>    
                    <div class="form-group col-sm-3">
                        <select name="group" class="form-control">
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>" <?php if(request()->input('group') == $group->id): ?> selected <?php endif; ?>><?php echo e($group->name); ?></option>                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <input type="submit" value="submit" class="btn btn-default">
                    </div>
                </div>
            </form>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Group Name</th>
                    <th>Group Type</th>
                    <th>Account name</th>
                    <th>Post Text</th>
                    <th>Time</th>
                </tr>
                <?php $__currentLoopData = $BufferPosting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php if($post->groupInfo): ?><?php echo e($post->groupInfo->name); ?><?php endif; ?></td>
                        <td><?php if($post->groupInfo): ?><?php echo e($post->groupInfo->type); ?><?php endif; ?></td>
                        <td>
                            <?php if($post->accountInfo): ?>
                            <img src="<?php echo e($post->accountInfo->avatar); ?>" width="40" class="circle" alt="">
                            <?php endif; ?>
                        </td>
                        
                    <td><?php echo e($post->post_text); ?></td>
                    <td><?php echo e(date("d M Y", strtotime($post->sent_at))); ?> | <?php if($post->accountInfo): ?><?php echo e($post->accountInfo->timezone); ?><?php endif; ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>

            <?php if(request()->has("search")): ?>
            <?php echo e($BufferPosting->appends(['search' => request()->input('search')])->links()); ?>

            <?php elseif(request()->has("date")): ?>
            <?php echo e($BufferPosting->appends(['date' => request()->input('date')])->links()); ?>

            <?php elseif(request()->has("group")): ?>
            <?php echo e($BufferPosting->appends(['group' => request()->input('group')])->links()); ?>

            <?php else: ?>
            <?php echo e($BufferPosting->links()); ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>