<div>
  <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit ">

    {{-- BRAND --}}
    <x-app-brand class="px-5 pt-4" />



    {{-- MENU --}}
    <x-menu activate-by-route class="md:pt-8 ">

      @if ($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
          <x-slot:actions>
            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate
              link="/logout" />
          </x-slot:actions>
        </x-list-item>
      @endif

      <x-menu-item title="Dashboard" icon="o-chart-bar-square" link="/admin/dashboard1" :class="request()->is('dashboard.list') ? 'active' : ''" />
      <x-menu-separator title="Master Data" icon="o-sparkles" />
      <x-menu-item title="Barang" icon="o-cube" link="/admin/barang/" :class="request()->is('\barang') ? 'active' : ''" />
      <x-menu-item title="Cabang" icon="o-building-office" link="/admin/cabang/" :class="request()->is('barang/') ? 'active' : ''" />
      <x-menu-item title="Gudang" icon="o-home-modern" link="/admin/gudang/" :class="request()->is('gudang/') ? 'active' : ''" />
      <x-menu-item title="Pegawai" icon="o-user-circle" link="/admin/pegawai/" :class="request()->is('pegawai/') ? 'active' : ''" />
      <x-menu-item title="Pelanggan" icon="o-users" link="/admin/pelanggan/" :class="request()->is('pelanggan/') ? 'active' : ''" />
      <x-menu-item title="Rak" icon="o-rectangle-group" link="/admin/rak/" :class="request()->is('rak/') ? 'active' : ''" />
      <x-menu-item title="Kategori Rak" icon="o-tag" link="/admin/rak-kategori/" :class="request()->is('rak-karegori/') ? 'active' : ''" />


      <x-menu-sub title="Pengaturan" icon="o-cog-6-tooth">
        <x-menu-item title="Logout" icon="o-tag" link="/admin/logout/" :class="request()->is('admin-logout/') ? 'active' : ''" />
        <x-menu-item title="Setting" icon-right="o-arrow-long-right" link="####" />
        <x-menu-item title="Backup" icon="o-arrow-long-right" link="####" />
      </x-menu-sub>

    </x-menu>
  </x-slot:sidebar>
</div>
