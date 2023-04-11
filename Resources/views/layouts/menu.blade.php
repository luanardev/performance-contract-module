<li class="nav-item">
    <a href="{{route('performance_contract.home')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-home"></i>
            Home
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('performance_contract.plan.create')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-plus-circle"></i>
            Planning
        </p>

    </a>
</li>

<li class="nav-item">
    <a href="{{route('performance_contract.plan.index')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-files-o"></i>
            My Plans
        </p>

    </a>
</li>

@if(can_appraise())
<li class="nav-item">
    <a href="{{route('performance_contract.appraisal.index')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-check-circle"></i>
            Appraisals
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('performance_contract.report')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-chart-pie"></i>
            Report
        </p>
    </a>
</li>
@endif

<li class="nav-item">
    <a href="{{route('performance_contract.shared.inbox')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-inbox"></i>
            Inbox
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('performance_contract.shared.outbox')}}" class="nav-link">
        <p>
            <i class="nav-icon fas fa-share-square"></i>
            Outbox
        </p>

    </a>
</li>



