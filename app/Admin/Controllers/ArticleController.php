<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'));
//        $grid->column('category_id', __('Category id'));
        $grid->column('category_id', __('分类ID'));
//        $grid->column('description', __('Description'));
        $grid->column('description', __('描述'));
//        $grid->column('comments', __('Comments'));
        $grid->column('comments', __('评论数'));
//        $grid->column('favs', __('Favs'));
        $grid->column('favs', __('收藏数'));
//        $grid->column('status', __('Status'));
        $grid->column('status', __('状态'));
//        $grid->column('conver', __('Conver'));
        $grid->column('conver','封面')->image();
        $grid->column('created_date', __('Created date'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('category_id', __('Category id'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('comments', __('Comments'));
        $show->field('favs', __('Favs'));
        $show->field('status', __('Status'));
        $show->field('conver', __('Conver'))->image();
        $show->field('created_date', __('Created date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article());

        $form->text('title', __('标题'));
        $form->number('category_id', __('Category id'));
        $form->text('description', __('Description'));
//        $form->UEditor('content');
        $form->UEditor('content')->options(['initialFrameHeight' => 500]);
//        $form->editor('content');
//        $form->summernote('content');
//        $form->quill('content');
//        $form->ckeditor('content');
//        $form->simditor('content');
        $form->number('comments', __('Comments'));
        $form->number('favs', __('Favs'));
        $form->switch('status', __('Status'));
        $form->image('conver', __('封面图'));
        $form->date('created_date', __('Created date'))->default(date('Y-m-d'));

        return $form;
    }
}
