<?php

namespace App\Constants;

use function Laravel\Prompts\select;

class PermissionConstant
{

    const ADMINS = 'مدیریت مدیران';
    const ROLES = 'مدیریت  نقش  ها ';
    const PERMISSIONS = 'مدیریت  نقش  ها ';
    const PRODUCTS = 'مدیریت  محصولات ';
    const USERS = 'مدیریت کاربران';
    const CATEGORIES = 'مدیریت دسته بندی ها';
    const ORDERS = 'مدیریت  سفارشات ';
    const PAYMENTS = 'مدیریت  پرداخت ها ';
    const BLOGS = 'مدیریت وبلاگ';
    const COMMENTS = 'مدیریت نظرات';
    const CALL_REQUESTS = 'مدیریت درخواست های تماس';
    const EMPLOYEES = 'مدیریت اعضا';
    const INSTAGRAM_POSTS = 'مدیریت پست های اینستاگرام';
    const SLIDERS = 'مدیریت اسلایدر';

    public static function getGropNamePermissions($key = null)
    {
        $groupPermissions = [
            'admins' => self::ADMINS,
            'roles' => self::ROLES,
            'permissions' => self::PERMISSIONS,
            'products' => self::PRODUCTS,
            'users' => self::USERS,
            'categories' => self::CATEGORIES,
            'orders' => self::ORDERS,
            'payments' => self::PAYMENTS,
            'blogs' => self::BLOGS,
            'comments' => self::COMMENTS,
            'call-requests' => self::CALL_REQUESTS,
            'employees' => self::EMPLOYEES,
            'instagram_posts' => self::INSTAGRAM_POSTS,
            'sliders' => self::SLIDERS
        ];

        return (!is_null($key)) ? $groupPermissions[$key] : $groupPermissions;
    }

    public static function getDefaultPermissionScopes(){
        return [
            self::adminsPermissions(),
            self::rolesPermissions(),
            self::permissionsPermissions(),
            self::usersPermissions(),
            self::categoriesPermissions(),
            self::productPermissions(),
            self::ordersPermissions(),
            self::paymentsPermissions(),
            self::blogPermissions(),
            self::commentsPermissions(),
            self::callRequestsPermissions(),
            self::employeesPermissions(),
            self::instagramPostsPermissions(),
            self::slidersPermissions()
        ];
    }

    private static function adminsPermissions()
    {
        return [
            [
                'entity' => 'admins',
                'page' => 'مدیریت مدیران',
                'name' => 'admins.all',
                'persian_name' => 'مدیریت مدیران',

            ],
            [
                'entity' => 'admins',
                'page' => 'مدیریت مدیران',
                'name' => 'admins.list',
                'persian_name' => 'لیست مدیران',

            ],
            [
                'entity' => 'admins',
                'page' => 'مدیریت مدیران',
                'name' => 'admins.create',
                'persian_name' => '  ثبت مدیر جدید ',

            ],
            [
                'entity' => 'admins',
                'page' => 'مدیریت مدیران',
                'name' => 'admins.edit',
                'persian_name' => '  ویرایش مدیر',

            ],
            [
                'entity' => 'admins',
                'page' => 'مدیریت مدیران',
                'name' => 'admins.delete',
                'persian_name' => '  حذف مدیر  ',

            ],

        ];
    }

    private static function rolesPermissions()
    {
        return [
            [
                'entity' => 'roles',
                'page' => 'مدیریت نقش ها  ',
                'name' => 'roles.all',
                'persian_name' => 'مدیریت نقش ها',

            ],
            [
                'entity' => 'roles',
                'page' => 'مدیریت نقش ها  ',
                'name' => 'roles.list',
                'persian_name' => 'لیست  نقش ها',

            ],
            [
                'entity' => 'roles',
                'page' => 'مدیریت نقش ها  ',
                'name' => 'roles.create',
                'persian_name' => ' ثبت نقش جدید ',

            ],
            [
                'entity' => 'roles',
                'page' => 'مدیریت نقش ها  ',
                'name' => 'roles.edit',
                'persian_name' => '  ویرایش نقش ',

            ],
            [
                'entity' => 'roles',
                'page' => 'مدیریت نقش ها  ',
                'name' => 'roles.delete',
                'persian_name' => '  حذف نقش  ',

            ],

        ];
    }

    private static function permissionsPermissions()
    {
        return [
            [
                'entity' => 'permissions',
                'page' => 'مدیریت مجوز ها  ',
                'name' => 'permissions.all',
                'persian_name' => 'مدیریت مجوز ها',

            ],
            [
                'entity' => 'permissions',
                'page' => 'مدیریت مجوز ها  ',
                'name' => 'permissions.list',
                'persian_name' => 'لیست  مجوز ها',

            ],

        ];
    }

    private static function usersPermissions()
    {
        return [
            [
                'entity' => 'users',
                'page' => 'مدیریت کاربران',
                'name' => 'users.all',
                'persian_name' => 'مدیریت کاربران',

            ],
            [
                'entity' => 'users',
                'page' => 'مدیریت کاربران',
                'name' => 'users.list',
                'persian_name' => 'لیست کاربران',

            ],
            [
                'entity' => 'users',
                'page' => 'مدیریت کاربران',
                'name' => 'users.create',
                'persian_name' => '  ثبت کاربر جدید ',

            ],
            [
                'entity' => 'users',
                'page' => 'مدیریت کاربران',
                'name' => 'users.edit',
                'persian_name' => '  ویرایش کاربر',

            ],
            [
                'entity' => 'users',
                'page' => 'مدیریت کاربران',
                'name' => 'users.delete',
                'persian_name' => '  حذف کاربر  ',

            ],

        ];
    }

    private static function categoriesPermissions()
    {
        return [
            [
                'entity' => 'categories',
                'page' => 'مدیریت دسته بندی ها ',
                'name' => 'categories.all',
                'persian_name' => 'مدیریت دسته بندی ها',

            ],
            [
                'entity' => 'categories',
                'page' => 'مدیریت دسته بندی ها ',
                'name' => 'categories.list',
                'persian_name' => 'لیست دسته بندی ها',

            ],
            [
                'entity' => 'categories',
                'page' => 'مدیریت دسته بندی ها',
                'name' => 'categories.create',
                'persian_name' => '  ثبت  دسته بندی جدید',

            ],
            [
                'entity' => 'categories',
                'page' => 'مدیریت دسته بندی ها ',
                'name' => 'categories.edit',
                'persian_name' => '  ویرایش دسته بندی ',

            ],
            [
                'entity' => 'categories',
                'page' => 'مدیریت دسته بندی ها ',
                'name' => 'categories.delete',
                'persian_name' => '  حذف دسته بندی  ',

            ],

        ];
    }

    private static function productPermissions()
    {
        return [
            [
                'entity' => 'products',
                'page' => 'مدیریت محصولات ',
                'name' => 'products.all',
                'persian_name' => 'مدیریت محصولات',

            ],
            [
                'entity' => 'products',
                'page' => 'مدیریت محصولات ',
                'name' => 'products.list',
                'persian_name' => 'لیست محصولات',

            ],
            [
                'entity' => 'products',
                'page' => 'مدیریت محصولات',
                'name' => 'products.create',
                'persian_name' => '  ثبت  محصول جدید',

            ],
            [
                'entity' => 'products',
                'page' => 'مدیریت محصولات ',
                'name' => 'products.edit',
                'persian_name' => '  ویرایش محصول ',

            ],
            [
                'entity' => 'products',
                'page' => 'مدیریت محصولات ',
                'name' => 'products.delete',
                'persian_name' => '  حذف محصول  ',

            ],

        ];
    }

    private static function blogPermissions()
    {
        return [
            [
                'entity' => 'blogs',
                'page' => 'مدیریت وبلاگ ',
                'name' => 'blogs.all',
                'persian_name' => 'مدیریت وبلاگ',

            ],
            [
                'entity' => 'blogs',
                'page' => 'مدیریت وبلاگ ',
                'name' => 'blogs.list',
                'persian_name' => 'لیست وبلاگ',

            ],
            [
                'entity' => 'blogs',
                'page' => 'مدیریت وبلاگ',
                'name' => 'blogs.create',
                'persian_name' => '  ثبت  بلاگ جدید',

            ],
            [
                'entity' => 'blogs',
                'page' => 'مدیریت وبلاگ ',
                'name' => 'blogs.edit',
                'persian_name' => '  ویرایش بلاگ ',

            ],
            [
                'entity' => 'blogs',
                'page' => 'مدیریت وبلاگ ',
                'name' => 'blogs.delete',
                'persian_name' => '  حذف بلاگ  ',

            ],

        ];
    }

    private static function ordersPermissions()
    {
        return [

            [
                'entity' => 'orders',
                'page' => 'مدیریت سفارشات ',
                'name' => 'orders.list',
                'persian_name' => 'لیست  سفارشات',

            ],


        ];
    }

    private static function paymentsPermissions()
    {
        return [

            [
                'entity' => 'payments',
                'page' => 'مدیریت پرداخت ها ',
                'name' => 'payments.list',
                'persian_name' => 'لیست  پرداخت ها',

            ],


        ];
    }

    private static function commentsPermissions()
    {
        return [
            [
                'entity' => 'comments',
                'page' => 'مدیریت نظرات ',
                'name' => 'comments.all',
                'persian_name' => 'مدیریت نظرات',

            ],
            [
                'entity' => 'comments',
                'page' => 'مدیریت نظرات ',
                'name' => 'comments.list',
                'persian_name' => 'لیست نظرات',

            ],
            [
                'entity' => 'comments',
                'page' => 'مدیریت نظرات',
                'name' => 'comments.create',
                'persian_name' => '  ثبت  نظر جدید',

            ],
            [
                'entity' => 'comments',
                'page' => 'مدیریت نظرات ',
                'name' => 'comments.edit',
                'persian_name' => '  ویرایش نظر ',

            ],
            [
                'entity' => 'comments',
                'page' => 'مدیریت نظرات ',
                'name' => 'comments.delete',
                'persian_name' => '  حذف نظر  ',

            ],

        ];
    }

    private static function callRequestsPermissions()
    {
        return [
            [
                'entity' => 'call-requests',
                'page' => 'مدیریت درخواست ها ',
                'name' => 'call-requests.all',
                'persian_name' => 'مدیریت درخواست ها',

            ],
            [
                'entity' => 'call-requests',
                'page' => 'مدیریت درخواست ها ',
                'name' => 'call-requests.list',
                'persian_name' => 'لیست درخواست ها',

            ],

        ];
    }

    private static function employeesPermissions()
    {
        return [
            [
                'entity' => 'employees',
                'page' => 'مدیریت نظرات ',
                'name' => 'employees.all',
                'persian_name' => 'مدیریت نظرات',

            ],
            [
                'entity' => 'employees',
                'page' => 'مدیریت اعضا ',
                'name' => 'employees.list',
                'persian_name' => 'لیست اعضا',

            ],
            [
                'entity' => 'employees',
                'page' => 'مدیریت اعضا',
                'name' => 'employees.create',
                'persian_name' => '  ثبت  عضو جدید',

            ],
            [
                'entity' => 'employees',
                'page' => 'مدیریت اعضا ',
                'name' => 'employees.edit',
                'persian_name' => '  ویرایش عضو ',

            ],
            [
                'entity' => 'employees',
                'page' => 'مدیریت اعضا ',
                'name' => 'employees.delete',
                'persian_name' => '  حذف عضو  ',

            ],

        ];
    }

    private static function instagramPostsPermissions()
    {
        return [

            [
                'entity' => 'instagram_posts',
                'page' => 'مدیریت پست های اینستاگرام ',
                'name' => 'instagram_posts.all',
                'persian_name' => '  مدیریت پست های اینستاگرام ',

            ],

        ];
    }

    private static function slidersPermissions()
    {
        return [

            [
                'entity' => 'sliders',
                'page' => 'مدیریت اسلایدر ',
                'name' => 'sliders.all',
                'persian_name' => '  مدیریت اسلایدر ',

            ],

        ];
    }
}
