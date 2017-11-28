<?php $__env->startSection('title', 'Udistro | Dashboard'); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-phone fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo e($clientCount); ?></div>
                                <div>Contacts</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo e(url('/agent/clients')); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('agent.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>