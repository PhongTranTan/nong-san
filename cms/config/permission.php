<?php
return [
    'permission' => [
        'model' => 'Admin',
        'permissions' => [
            'admin.index' => 'Access'
        ]
    ],

    'menu' => [
        'model' => 'Quản lý Danh mục Menu',
        'permissions' => [
            'admin.menu.index' => 'Truy cập',
            'admin.menu.create' => 'Tạo',
            'admin.menu.edit' => 'Sửa',
            'admin.menu.destroy' => 'Xóa'
        ]
    ],

    'menu_item' => [
        'model' => 'Quản lý Menu',
        'permissions' => [
            'admin.menu.item.index' => 'Truy cập',
            'admin.menu.item.create' => 'Tạo',
            'admin.menu.item.edit' => 'Sửa',
            'admin.menu.item.destroy' => 'Xóa'
        ]
    ],

    'customer' => [
        'model' => 'Customer',
        'permissions' => [
            'admin.customer.index' => 'Access',
            'admin.customer.create' => 'Create',
            'admin.customer.edit' => 'Edit',
            'admin.customer.destroy' => 'Delete',
        ]
    ],


    'logopartner' => [
        'model' => 'Partner',
        'permissions' => [
            'admin.logopartner.index' => 'Access',
            'admin.logopartner.create' => 'Create',
            'admin.logopartner.edit' => 'Edit',
            'admin.logopartner.destroy' => 'Delete',
        ]
    ],

    'guides' => [
        'model' => 'Guides',
        'permissions' => [
            'admin.guides.index' => 'Access',
            'admin.guides.create' => 'Create',
            'admin.guides.edit' => 'Edit',
            'admin.guides.destroy' => 'Delete',
        ]
    ],

    'guides-category' => [
        'model' => 'Guides Category',
        'permissions' => [
            'admin.guides.category.index' => 'Access',
            'admin.guides.category.create' => 'Create',
            'admin.guides.category.edit' => 'Edit',
            'admin.guides.category.destroy' => 'Delete',
        ]
    ],

    'news' => [
        'model' => 'News',
        'permissions' => [
            'admin.news.index' => 'Access',
            'admin.news.create' => 'Create',
            'admin.news.edit' => 'Edit',
            'admin.news.destroy' => 'Delete',
        ]
    ],

    'news-category' => [
        'model' => 'News Category',
        'permissions' => [
            'admin.news.category.index' => 'Access',
            'admin.news.category.create' => 'Create',
            'admin.news.category.edit' => 'Edit',
            'admin.news.category.destroy' => 'Delete',
        ]
    ],

    'banner' => [
        'model' => 'Banner',
        'permissions' => [
            'admin.banner.index' => 'Access',
            'admin.banner.create' => 'Create',
            'admin.banner.edit' => 'Edit',
            'admin.banner.destroy' => 'Delete',
        ]
    ],

    'sibor_rates' => [
        'model' => 'Sibor Rates',
        'permissions' => [
            'admin.siborrates.index' => 'Access',
            'admin.siborrates.create' => 'Create',
            'admin.siborrates.edit' => 'Edit',
            'admin.siborrates.destroy' => 'Delete',
        ]
    ],

    'mortgage' => [
        'model' => 'Mortgage Rates',
        'permissions' => [
            'admin.mortgage.index' => 'Access',
            'admin.mortgage.create' => 'Create',
            'admin.mortgage.edit' => 'Edit',
            'admin.mortgage.destroy' => 'Delete',
        ]
    ],

    'district' => [
        'model' => 'District',
        'permissions' => [
            'admin.district.index' => 'Access',
            'admin.district.create' => 'Create',
            'admin.district.edit' => 'Edit',
            'admin.district.destroy' => 'Delete',
        ]
    ],

    'tenure' => [
        'model' => 'Tenure',
        'permissions' => [
            'admin.tenure.index' => 'Access',
            'admin.tenure.create' => 'Create',
            'admin.tenure.edit' => 'Edit',
            'admin.tenure.destroy' => 'Delete',
        ]
    ],

    'purpose' => [
        'model' => 'Purpose',
        'permissions' => [
            'admin.purpose.index' => 'Access',
            'admin.purpose.create' => 'Create',
            'admin.purpose.edit' => 'Edit',
            'admin.purpose.destroy' => 'Delete',
        ]
    ],

    'direction' => [
        'model' => 'Direction',
        'permissions' => [
            'admin.direction.index' => 'Access',
            'admin.direction.create' => 'Create',
            'admin.direction.edit' => 'Edit',
            'admin.direction.destroy' => 'Delete',
        ]
    ],

    'budgets' => [
        'model' => 'Budgets',
        'permissions' => [
            'admin.budgets.index' => 'Access',
            'admin.budgets.create' => 'Create',
            'admin.budgets.edit' => 'Edit',
            'admin.budgets.destroy' => 'Delete',
        ]
    ],

    'type' => [
        'model' => 'Project Type',
        'permissions' => [
            'admin.type.index' => 'Access',
            'admin.type.create' => 'Create',
            'admin.type.edit' => 'Edit',
            'admin.type.destroy' => 'Delete',
        ]
    ],

    'project' => [
        'model' => 'Project',
        'permissions' => [
            'admin.project.index' => 'Access',
            'admin.project.create' => 'Create',
            'admin.project.edit' => 'Edit',
            'admin.project.destroy' => 'Delete',
        ]
    ],

    'linkreport' => [
        'model' => 'Link Report',
        'permissions' => [
            'admin.linkreport.index' => 'Access',
            'admin.linkreport.create' => 'Create',
            'admin.linkreport.edit' => 'Edit',
            'admin.linkreport.destroy' => 'Delete',
        ]
    ],

    'floorcategory' => [
        'model' => 'Project Category',
        'permissions' => [
            'admin.floorcategory.index' => 'Access',
            'admin.floorcategory.create' => 'Create',
            'admin.floorcategory.edit' => 'Edit',
            'admin.floorcategory.destroy' => 'Delete',
        ]
    ],

    'floortype' => [
        'model' => 'Project Type',
        'permissions' => [
            'admin.floortype.index' => 'Access',
            'admin.floortype.create' => 'Create',
            'admin.floortype.edit' => 'Edit',
            'admin.floortype.destroy' => 'Delete',
        ]
    ],

    'testimonials' => [
        'model' => 'Testimonials',
        'permissions' => [
            'admin.testimonials.index' => 'Access',
            'admin.testimonials.create' => 'Create',
            'admin.testimonials.edit' => 'Edit',
            'admin.testimonials.destroy' => 'Delete',
        ]
    ],

    'theme' => [
        'model' => 'Themes',
        'permissions' => [
            'admin.theme.index' => 'Access',
            'admin.theme.create' => 'Create',
            'admin.theme.edit' => 'Edit',
            'admin.theme.destroy' => 'Delete',
        ]
    ],

    'page' => [
        'model' => 'Page',
        'permissions' => [
            'admin.page.index' => 'Access',
            'admin.page.create' => 'Create',
            'admin.page.edit' => 'Edit',
            'admin.page.destroy' => 'Delete'
        ]
    ],

    'schedule' => [
        'model' => 'Schedule Showflat',
        'permissions' => [
            'admin.schedule.index' => 'Access',
            'admin.schedule.destroy' => 'Delete'
        ]
    ],

    'contact' => [
        'model' => 'Contact',
        'permissions' => [
            'admin.contact.index' => 'Access',
            'admin.contact.destroy' => 'Delete'
        ]
    ],

    'subscribe' => [
        'model' => 'Subscribe',
        'permissions' => [
            'admin.subscribe.index' => 'Access',
            'admin.subscribe.destroy' => 'Delete'
        ]
    ],

    'general' => [
        'model' => 'General',
        'permissions' => [
            'admin.general.index' => 'Access',
            'admin.general.create' => 'Create',
            'admin.general.edit' => 'Edit',
            'admin.general.destroy' => 'Delete'
        ]
    ],

    'user' => [
        'model' => 'Users',
        'permissions' => [
            'admin.user.index' => 'Access',
            'admin.user.create' => 'Create',
            'admin.user.edit' => 'Edit',
            'admin.user.destroy' => 'Delete',
            'admin.user.set.permission' => 'Set Permission'
        ]
    ],

    'role' => [
        'model' => 'Role',
        'permissions' => [
            'admin.role.index' => 'Access',
            'admin.role.create' => 'Create',
            'admin.role.edit' => 'Edit',
            'admin.role.destroy' => 'Delete'
        ]
    ],

    'system' => [
        'model' => 'System',
        'permissions' => [
            'admin.system.edit' => 'Edit',
        ]
    ],
];
