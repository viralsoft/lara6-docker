<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Store and Inventory</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('admin/stores*') ? 'active' : '' }}">
            <a href="{!! route('admin.stores.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.store') }}
            </a>
        </li>
        <li class="{{ Request::is('admin/warehouses*') ? 'active' : '' }}">
            <a href="{!! route('admin.warehouses.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.warehouse') }}
            </a>
        </li>
        <li class="{{ Request::is('admin/vendors*') ? 'active' : '' }}">
            <a href="{!! route('admin.vendors.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.vendor.index') }}
            </a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Product</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('admin/units*') ? 'active' : '' }}">
            <a href="{!! route('admin.units.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.unit') }}
            </a>
        </li>
        <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
            <a href="{!! route('admin.products.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.product') }}
            </a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Order</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('admin/imports*') ? 'active' : '' }}">
            <a href="{!! route('admin.imports.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.import') }}
            </a>
        </li>
        <li class="{{ Request::is('admin/exports*') ? 'active' : '' }}">
            <a href="{!! route('admin.exports.index') !!}">
                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA"></i>
                {{ __('virals-inventory::labels.export.index') }}
            </a>
        </li>
    </ul>
</li>
