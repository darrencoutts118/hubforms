<ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
        <a class="nav-link @if($active=='overview') active @endif" href="{{ route('admin.forms.show', $form) }}"><i class="fa fa-sticky-note"></i> Overview</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active=='submissions') active @endif" href="{{ route('admin.submissions.index', $form) }}"><i class="fa fa-pen"></i> Submissions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  @if($active=='fields') active @endif" href="{{ route('admin.fields.index', $form) }}"><i class="fa fa-align-justify"></i> Fields</a>
    </li>
</ul>
