@if($bundles)
    <a id="bundle"></a>
    <div class="col-md-12">
        <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold">Paket</h3>
        </div>

        @foreach($bundles as $bundle)
            <!-- Bundle Details -->
            @php
                $b_detail = $bundle['bundle'];
            @endphp
            <div class="mb-2 hidden-xs">
                <div class="row">
                    <div class="col-md-7">
                        <p>
                            <strong>{{ $b_detail->name }} ({{ $b_detail->formatted_price }})</strong>
                        </p>
                    </div>
                    <div class="col-md-5">
                        @if($b_detail->is_purchased)
                            <button class="pull-right btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square bg-medium-yellow" disabled>
                                Telah Dibeli
                            </button>
                        @else
                            <button class="pull-right btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square btn-package-purchase bg-medium-yellow" data-bundle-id="{{ $b_detail->id }}" data-bundle-name="{{ $b_detail->name }}" data-bundle-price="{{ $b_detail->formatted_price }}" data-bundle-clean-price="{{ $b_detail->price }}">
                                Beli Paket
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-2 hidden-lg hidden-sm hidden-md">
                <div class="col-md-12">
                    <div class="row">
                        <p>
                            <strong>{{ $b_detail->name }} ({{ $b_detail->formatted_price }})</strong>
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @if($b_detail->is_purchased)
                            <button class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square bg-medium-yellow" disabled>
                                Telah Dibeli
                            </button>
                        @else
                            <button class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square bg-medium-yellow btn-package-purchase" data-bundle-id="{{ $b_detail->id }}" data-bundle-name="{{ $b_detail->name }}" data-bundle-price="{{ $b_detail->formatted_price }}" data-bundle-clean-price="{{ $b_detail->price }}">
                                Beli Paket
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Bundle Details -->

            <!-- Bundle List Products -->
            <div class="row mb-2">
                <div class="bundle owl-carousel owl-theme c-theme owl-small-space c-owl-nav-center">
                    @foreach($bundle['products'] as $b_prod)
                        <div class="item">
                            <div class="c-content-product-2 c-bg-white c-border">
                                <div class="c-content-overlay">
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="{{ $b_prod->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                                        </div>
                                    </div>
                                    <img class="img-responsive" src="{{ $b_prod->image_full_url }}"/>
                                </div>
                                <div class="c-info bundle">
                                    <a href="{{ $b_prod->route_url }}">
                                        <p class="c-title c-font-18 c-font-slim">{{ $b_prod->name }}</p>
                                    </a>
                                </div>
                                <div class="btn-group btn-group-justified" role="group">
                                    <div class="btn-group c-border-left c-border-top" role="group">
                                        <a href="{{ $b_prod->route_url }}" class="btn btn-lg c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End Bundle List Products -->

        @endforeach
    </div>
@endif