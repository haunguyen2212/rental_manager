<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MailLogRepository;
use Illuminate\Http\Request;

class MailLogController extends Controller
{

    protected $mailLogRepository;

    public function __construct(
        MailLogRepository $mailLogRepository
    ){
        $this->mailLogRepository = $mailLogRepository;
    }

    /**
     * Display a listing of sent mails.
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        try{
            $data['mails'] = $this->mailLogRepository->searchListMail([]);
            // Dữ liệu giả cho danh sách mail đã gửi
//             $data['mails'] = collect([
//                 (object)[
//                     'id' => 1,
//                     'to' => 'customer1@example.com',
//                     'to_name' => 'Nguyễn Văn A',
//                     'subject' => 'Xác nhận đơn hàng #12345',
//                     'status' => 'sent',
//                     'status_text' => 'Đã gửi',
//                     'sent_at' => now()->subMinutes(10),
//                     'template' => 'order_confirmation',
//                     'content' => 'Kính chào Nguyễn Văn A,

// Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi!

// Thông tin đơn hàng:
// - Mã đơn hàng: #12345
// - Ngày đặt: 15/01/2024
// - Tổng tiền: 2,500,000 VNĐ
// - Phương thức thanh toán: Chuyển khoản

// Đơn hàng của bạn đang được xử lý và sẽ được giao trong vòng 3-5 ngày làm việc.

// Trân trọng,
// Đội ngũ hỗ trợ khách hàng',
//                     'attachments' => ['invoice_12345.pdf'],
//                 ],
//                 (object)[
//                     'id' => 2,
//                     'to' => 'customer2@example.com',
//                     'to_name' => 'Trần Thị B',
//                     'subject' => 'Thông báo giao hàng',
//                     'status' => 'sent',
//                     'status_text' => 'Đã gửi',
//                     'sent_at' => now()->subHours(1),
//                     'template' => 'shipping_notification',
//                     'content' => 'Kính chào Trần Thị B,

// Đơn hàng #12346 của bạn đã được giao cho đơn vị vận chuyển.

// Thông tin vận chuyển:
// - Mã vận đơn: VN123456789
// - Đơn vị vận chuyển: Giao hàng nhanh
// - Dự kiến nhận hàng: 18/01/2024

// Bạn có thể theo dõi đơn hàng qua mã vận đơn trên website của đơn vị vận chuyển.

// Trân trọng,
// Đội ngũ hỗ trợ khách hàng',
//                     'attachments' => [],
//                 ],
//                 (object)[
//                     'id' => 3,
//                     'to' => 'customer3@example.com',
//                     'to_name' => 'Lê Văn C',
//                     'subject' => 'Khuyến mãi đặc biệt tháng 1',
//                     'status' => 'sent',
//                     'status_text' => 'Đã gửi',
//                     'sent_at' => now()->subHours(3),
//                     'template' => 'promotion',
//                     'content' => 'Kính chào Lê Văn C,

// Chúng tôi xin gửi đến bạn chương trình khuyến mãi đặc biệt trong tháng 1:

// 🎉 Giảm giá 20% cho tất cả sản phẩm điện tử
// 🎁 Miễn phí vận chuyển cho đơn hàng trên 500,000 VNĐ
// 💎 Tặng voucher 50,000 VNĐ cho khách hàng mới

// Chương trình áp dụng từ ngày 01/01/2024 đến 31/01/2024.

// Hãy nhanh tay đặt hàng để nhận được những ưu đãi hấp dẫn này!

// Trân trọng,
// Đội ngũ Marketing',
//                     'attachments' => ['promo_banner.jpg'],
//                 ],
//                 (object)[
//                     'id' => 4,
//                     'to' => 'customer4@example.com',
//                     'to_name' => 'Phạm Thị D',
//                     'subject' => 'Xác nhận đăng ký tài khoản',
//                     'status' => 'sent',
//                     'status_text' => 'Đã gửi',
//                     'sent_at' => now()->subHours(5),
//                     'template' => 'account_verification',
//                     'content' => 'Kính chào Phạm Thị D,

// Cảm ơn bạn đã đăng ký tài khoản tại website của chúng tôi!

// Để hoàn tất quá trình đăng ký, vui lòng xác nhận email của bạn bằng cách click vào link sau:

// [Link xác nhận email]

// Link này sẽ hết hạn sau 24 giờ.

// Nếu bạn không đăng ký tài khoản này, vui lòng bỏ qua email này.

// Trân trọng,
// Đội ngũ hỗ trợ',
//                     'attachments' => [],
//                 ],
//                 (object)[
//                     'id' => 5,
//                     'to' => 'customer5@example.com',
//                     'to_name' => 'Hoàng Văn E',
//                     'subject' => 'Nhắc nhở thanh toán đơn hàng',
//                     'status' => 'sent',
//                     'status_text' => 'Đã gửi',
//                     'sent_at' => now()->subDays(1),
//                     'template' => 'payment_reminder',
//                     'content' => 'Kính chào Hoàng Văn E,

// Chúng tôi xin nhắc nhở bạn về đơn hàng #12347 chưa được thanh toán.

// Thông tin đơn hàng:
// - Mã đơn hàng: #12347
// - Tổng tiền: 1,800,000 VNĐ
// - Hạn thanh toán: 16/01/2024

// Vui lòng thanh toán đơn hàng trong vòng 24 giờ để đảm bảo đơn hàng được xử lý kịp thời.

// Link thanh toán: [Link thanh toán]

// Trân trọng,
// Đội ngũ hỗ trợ khách hàng',
//                     'attachments' => [],
//                 ],
//                 (object)[
//                     'id' => 6,
//                     'to' => 'customer6@example.com',
//                     'to_name' => 'Vũ Thị F',
//                     'subject' => 'Đánh giá sản phẩm',
//                     'status' => 'sent',
//                     'status_text' => 'Đã gửi',
//                     'sent_at' => now()->subDays(2),
//                     'template' => 'product_review',
//                     'content' => 'Kính chào Vũ Thị F,

// Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!

// Chúng tôi rất mong nhận được đánh giá của bạn về sản phẩm đã mua. Đánh giá của bạn sẽ giúp chúng tôi cải thiện dịch vụ và giúp các khách hàng khác có thêm thông tin tham khảo.

// Vui lòng click vào link sau để đánh giá sản phẩm:
// [Link đánh giá]

// Trân trọng,
// Đội ngũ hỗ trợ khách hàng',
//                     'attachments' => [],
//                 ],
//             ]);
            return view('admin.mail_log.index', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}

