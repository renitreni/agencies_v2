<div>
    <div class="toast" data-delay="10000" data-autohide="true" style="position: absolute;top: 12%;right: 2%;z-index: 100;" wire:ignore.self>
        <div class="toast-header">
            <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                <rect fill="#007aff" width="100%" height="100%" />
            </svg>
            <strong class="mx-3">Message</strong>
            <small class="text-muted">now</small>
        </div>
        <div class="toast-body me-3">
            <h4>{{ $message }}</h4>
        </div>
    </div>
</div>
