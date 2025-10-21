<?php


namespace App\Constants;
class Constant
{


    //categoriesTypes
    const BLOG = 'blog';
    const PRODUCT = 'product';

    //like
    const LIKE = "like";
    const DIS_LIKE = "dis_like";
    const HAS_IT = "has_it";
    const HAS_NO = "has_no";


    // Global Constant
    const UN_DEFINED = "un-defined";
    const ACTIVE = 'active';
    const IN_ACTIVE = 'in-active';
    const PENDING = 'pending';
    const CONFIRMED = 'confirm';
    const REJECTED = 'rejected';

    const EXPIRED = 'expired';
    const DRAFT = 'draft';
    const PUBLISHED = 'published';
    const SCHEDULED = 'scheduled';

    const CANCELED = 'canceled';
    const DELETED = 'deleted';
    const UN_DELETED = 'un-deleted';
    const UN_LOGIN = 'un_login';

    const TRUE = 'true';
    const FALSE = 'false';

    const ALL = 'all';

    // File Constant
    const IMAGE = 'image';
    const SOUND = 'sound';
    const VIDEO = 'video';
    const GIF = 'gif';
    const VOICE = 'voice';
    const FILE = 'file';
    const TEXT = 'text';


    //Ticket Priorities
    const FORCE = 'force';
    const NORMAL = 'normal';

    //Ticket Statuses
    const WAITING = 'waiting';
    const ANSWERED = 'answered';
    const CLOSED = 'closed';

    //Ticket Messenger types
    const ADMIN = 'admin';
    const USER = 'user';


    //purchase Types

    const BY_GATEWAY = 'by_gateway';
    const CART_YO_CART = 'cart_to_cart';

    const UN_PURCHASED = 'un_purchased';
    const PURCHASED = 'purchased';

    // Order Types
    const SUBMITTED = 'submitted';
    const SHIPPING = 'shipping';
    const DELIVERED = 'delivered';

    // Gateway and platform Names
    const BAZAAR = 'bazaar';
    const MYKET = 'myket';
    const GOOGLE = 'google';
    const SITE = 'site';
    const ZARINPAL = 'zarinpal';
    const CASH = 'cash';

    //Gender Constants
    const FEMALE = 'female';
    const MALE = 'male';
    const OTHER = 'other';

    // DiscountTypes
    const PERCENT = 'percent';
    const AMOUNT = 'amount';
    const WHITE_MIME_TYPE_LIST = [
        'image/jpeg', 'image/png', 'image/jpg', 'audio/mpeg', 'video/mp4','video/m4a','image/gif',
        'application/zip', 'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.rar', 'text/plain', 'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    const PRODUCT_AVATAR_SIZE = [
        '100' => ['w' => '100', 'h' => '100'],
        '300' => ['w' => '300', 'h' => '300']
    ];
    const USER_AVATAR_SIZE = [
        '100' => ['w' => '200', 'h' => '200'],
    ];

    // products
    const PRODUCT_IMAGE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . '';
    const PRODUCT_VIDEO_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'video' . DIRECTORY_SEPARATOR . '';
    const PRODUCT_GALLERY_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . '';

    // categories
    const CATEGORY_IMAGE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . '';


    // admins
    const ADMINS_IMAGE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'admins' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . '';

    // users
    const USERS_AVATAR_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . '';

    // slider
    const SLIDER_IMAGE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'sliders' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . '';

    //Tickets
    const TICKET_FILE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'tickets' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . '';

    //Slider
    const SLIDERS_FILE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'sliders' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR . '';

    //Slider
    const INSTAGRAM_POST_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'instagram' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR . '';

    //Blog
    const BLOG_MAIN_IMAGE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR . '';

    //Employee
    const EMPLOYEE_IMAGE_PATH = 'uploads' . DIRECTORY_SEPARATOR . 'employee' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . '';



    public static function getStatuses($status = null)
    {
        if (is_null($status)) {
            return [
                Constant::ACTIVE => 'فعال',
                Constant::IN_ACTIVE => ' غیر فعال',
            ];
        }
        if (in_array($status, array_keys(self::getStatuses()))) {
            return self::getStatuses()[$status];
        }
        return Constant::UN_DEFINED;
    }
    public static function getStatusesViewer()
    {
        $activeStatuses = self::getStatuses();
        $activeStatusesViewer = [];
        foreach ($activeStatuses as $key => $value) {
            $activeStatusesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $activeStatusesViewer;
    }


    public static function getStatusComments($status = null)
    {
        $categoryEntities = [
            self::PUBLISHED => 'منتشر شده',
            self::PENDING => 'در انتظار تایید',
            self::REJECTED => 'رد شده',

        ];
        if (is_null($status)) {
            return $categoryEntities;
        }
        if (in_array($status, array_keys($categoryEntities))) {
            return $categoryEntities[$status];
        }
    }

    public static function getStatusCommentsView(): array
    {
        $statusComments = self::getStatusComments();
        $statusCommentsView = [];
        foreach ($statusComments as $key => $value) {
            $statusCommentsView[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $statusCommentsView;
    }


    // Categories Types
    public static function getCategoryTypes($type = null)
    {
        if (is_null($type)) {
            return [
                Constant::PRODUCT => 'محصولات',
                Constant::BLOG => ' وبلاگ',
            ];
        }
        if (in_array($type, array_keys(self::getCategoryTypes()))) {
            return self::getCategoryTypes()[$type];
        }
        return Constant::UN_DEFINED;
    }
    public static function getCategoryTypesViewer()
    {
        $activeCategoryTypes = self::getCategoryTypes();
        $activeCategoryTypesViewer = [];
        foreach ($activeCategoryTypes as $key => $value) {
            $activeCategoryTypesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $activeCategoryTypesViewer;
    }


    public static function getPriorities($priority = null)
    {
        $priorities = [
            self::NORMAL => 'معمولی',
            self::FORCE=> 'ضروری',

        ];
        if (is_null($priority)) {
            return $priorities;
        }
        if (in_array($priority, array_keys($priorities))) {
            return $priorities[$priority];
        }
    }
    public static function getPrioritiesViewer()
    {
        $priorities = self::getPriorities();
        $prioritiesViewer = [];
        foreach ($priorities as $key => $value) {
            $prioritiesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $prioritiesViewer;
    }


    public static function getTicketStatuses($status = null)
    {
        if (is_null($status)) {
            return [
                Constant::WAITING => 'در انتظار',
                Constant::ANSWERED => 'جواب داده شده',
                Constant::CLOSED => 'بسته شده'
            ];
        }
        if (in_array($status, array_keys(self::getTicketStatuses()))) {
            return self::getTicketStatuses()[$status];
        }
        return Constant::UN_DEFINED;
    }
    public static function getTicketStatusesViewer()
    {
        $ticketStatuses = self::getTicketStatuses();
        $ticketStatusesViewer = [];
        foreach ($ticketStatuses as $key => $value) {
            $ticketStatusesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $ticketStatusesViewer;
    }

    public static function getUserGenders($gender = null)
    {
        if (is_null($gender)) {
            return [
                Constant::MALE => 'مرد',
                Constant::FEMALE => 'زن',
                Constant::OTHER => 'سایر'
            ];
        }
        if (in_array($gender, array_keys(self::getUserGenders()))) {
            return self::getUserGenders()[$gender];
        }
        return Constant::UN_DEFINED;
    }
    public static function getUserGendersViewer()
    {
        $userGenders = self::getUserGenders();
        $userGendersViewer = [];
        foreach ($userGenders as $key => $value) {
            $userGendersViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $userGendersViewer;
    }

    public static function getOrderStatuses($status = null)
    {
        if (is_null($status)) {
            return [
                self::PENDING => 'در انتظار',
                self::CANCELED => 'لغو شده',
                self::PURCHASED => 'پرداخت شده'
            ];
        }
        if (in_array($status, array_keys(self::getOrderStatuses()))) {
            return self::getOrderStatuses()[$status];
        }
        return Constant::UN_DEFINED;
    }
    public static function getOrderStatusesViewer()
    {
        $activeStatuses = self::getOrderStatuses();
        $activeStatusesViewer = [];
        foreach ($activeStatuses as $key => $value) {
            $activeStatusesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $activeStatusesViewer;
    }

    public static function getDeliveryStatuses($status = null)
    {
        if (is_null($status)) {
            return [
                self::PENDING => ' در انتظار ارسال',
                self::SHIPPING => 'در حال ارسال',
                self::DELIVERED => 'تحویل شده',
                self::REJECTED => 'مرجوع شده',
            ];
        }
        if (in_array($status, array_keys(self::getDeliveryStatuses()))) {
            return self::getDeliveryStatuses()[$status];
        }
        return Constant::UN_DEFINED;
    }
    public static function getDeliveryStatusesViewer()
    {
        $activeStatuses = self::getDeliveryStatuses();
        $activeStatusesViewer = [];
        foreach ($activeStatuses as $key => $value) {
            $activeStatusesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $activeStatusesViewer;
    }

    public static function getPaymentStatuses($status = null)
    {
        if (is_null($status)) {
            return [
                self::PENDING => 'در انتظار',
                self::REJECTED => 'رد شده',
                self::CONFIRMED => 'قبول شده'
            ];
        }
        if (in_array($status, array_keys(self::getPaymentStatuses()))) {
            return self::getPaymentStatuses()[$status];
        }
        return Constant::UN_DEFINED;
    }
    public static function getPaymentStatusesViewer()
    {
        $activeStatuses = self::getPaymentStatuses();
        $activeStatusesViewer = [];
        foreach ($activeStatuses as $key => $value) {
            $activeStatusesViewer[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $activeStatusesViewer;
    }


    public static function getFileType($file)
    {
        return [
            'image/jpeg' => Constant::IMAGE,
            'image/png' => Constant::IMAGE,
            'image/jpg' => Constant::IMAGE,
            'video/mp4' => Constant::VIDEO,
            'audio/mpeg' => Constant::SOUND,
            'audio/wav' => Constant::VOICE,
            'audio/aac' => Constant::VOICE,
            'audio/m4a' => Constant::VOICE,
        ][$file->getClientMimeType()];
    }



    public static function getFileTypeByStringInApi($fileType = null)
    {
        if (is_null($fileType)) {
            return [
                '.jpeg' => Constant::IMAGE,
                '.png' => Constant::IMAGE,
                '.jpg' => Constant::IMAGE,
                '.mp4' => Constant::VIDEO,
                '.mpeg' => Constant::SOUND,
                '.wav' => Constant::VOICE,
                '.aac' => Constant::VOICE,
                '.m4a' => Constant::VOICE,
            ];
        }
        if (in_array($fileType, array_keys(self::getFileTypeByStringInApi()))) {
            return self::getFileTypeByStringInApi()[$fileType];
        }
        return Constant::UN_DEFINED;
    }

    public static function getMorphClass($class)
    {
        return [
            'App\Models\Product' => 'محصولات',
            'App\Models\Blog' => 'وبلاگ',
            '' => 'ناشناخته'
        ][$class];
    }




    public static function getDiscountCodeTypes($type = null)
    {
        $discountTypes = [
            self::PERCENT => 'درصدی',
            self::AMOUNT => 'مقدار  ',
        ];
        if (is_null($type)) {
            return $discountTypes;
        }
        if (in_array($type, array_keys($discountTypes))) {
            return $discountTypes[$type];
        }
    }

    public static function getDiscountCodeTypesView(): array
    {
        $discountTypes = self::getDiscountCodeTypes();
        $discountTypesView = [];

        foreach ($discountTypes as $key => $value) {
            $discountTypesView[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $discountTypesView;

    }

    // post statuses
    public static function getBlogStatuses($type = null)
    {
        $statuses = [
            self::PUBLISHED => 'منتشر شده',
            self::DRAFT => 'بایگانی',
        ];
        if (is_null($type)) {
            return $statuses;
        }
        if (in_array($type, array_keys($statuses))) {
            return $statuses[$type];
        }
    }

    public static function getBlogStatusesView(): array
    {
        $statuses = self::getBlogStatuses();
        $statusesView = [];

        foreach ($statuses as $key => $value) {
            $statusesView[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $statusesView;

    }


    public static function getCallRequestsStatus($status = null)
    {
        $categoryEntities = [
            self::CONFIRMED => 'تایید شده',
            self::PENDING => 'در انتظار ',
            self::REJECTED => 'رد شده',

        ];
        if (is_null($status)) {
            return $categoryEntities;
        }
        if (in_array($status, array_keys($categoryEntities))) {
            return $categoryEntities[$status];
        }
    }

    public static function getCallRequestsStatusView(): array
    {
        $statusComments = self::getCallRequestsStatus();
        $statusCommentsView = [];
        foreach ($statusComments as $key => $value) {
            $statusCommentsView[] = [
                'id' => $key,
                'title' => $value
            ];
        }
        return $statusCommentsView;
    }

}
