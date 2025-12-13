@extends('admin.common.master')

@section('title', 'Hoạt động')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h5 class="card-title fw-semibold mb-0">Hoạt động</h5>
        </div>
        <div>
            <button type="button" class="btn btn-sm-md btn-primary btn-refresh">
                <i class="ti ti-refresh"></i>
                <span class="d-none d-sm-inline">Làm mới</span>
            </button>
        </div>
    </div>

    @if(isset($activities) && $activities->count() > 0)
        <div class="activity-timeline">
            @foreach ($activities as $index => $activity)
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <div class="timeline-icon bg-{{ ACTIVITY[$activity->action]['color'] ?? '' }}-subtle">
                            <i class="ti {{ ACTIVITY[$activity->action]['icon'] ?? '' }} text-{{ ACTIVITY[$activity->action]['color'] ?? '' }}"></i>
                        </div>
                        @if($index < $activities->count() - 1)
                            <div class="timeline-line"></div>
                        @endif
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <div class="user-avatar">
                                    @if($activity->user_avatar)
                                        <img src="{{ $activity->user_avatar }}" alt="{{ $activity->user_name }}" class="rounded-circle" width="32" height="32">
                                    @else
                                        <div class="avatar-placeholder bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">
                                            {{ mb_strtoupper(mb_substr($activity->user_name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-semibold">{{ $activity->user_name }}</h6>
                                    <small class="text-muted">
                                        <span class="badge bg-{{ ACTIVITY[$activity->action]['color'] ?? '' }}-subtle text-{{ ACTIVITY[$activity->action]['color'] ?? '' }} me-2">
                                            {{ $activity->action_text }}
                                        </span>
                                        <i class="ti ti-clock me-1"></i>
                                        {{ $activity->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-body">
                            <p class="mb-2">{!! $activity->description !!}</p>
                            <div class="timeline-meta d-flex align-items-center gap-3">
                                <small class="text-muted">
                                    <i class="ti ti-map-pin me-1"></i>
                                    {{ $activity->ip_address }}
                                </small>
                                <small class="text-muted">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $activity->created_at->format(DATETIME_FORMAT_VIEW) }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="ti ti-inbox fs-5 text-muted mb-3 d-block"></i>
            <p class="text-muted mb-0">Không có hoạt động nào</p>
        </div>
    @endif
@endsection

