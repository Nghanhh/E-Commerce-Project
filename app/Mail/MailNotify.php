<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    //Queueable: Quản lý xử lý queue.
    //SerializesModels: Serial hóa và tự động tải lại model.

    private $data = []; //data chỉ được truy cập trong class mà nó được khai báo

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct($data) //public: có thể truy cập bất cứ đâu, contruct: khởi tạo 
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     * 
     * @return $this $this đại diện cho instance của class hiện tại.
     */

    public function build()
    {
        // Các phương thức from(), subject(), view() đều là hàm built-in của Laravel, được định nghĩa trong class Mailable của Laravel
        return $this->from('jaimenguyen2412@gmail.com',"test")
                    ->subject($this->data['subject'])
                    ->view('email.index')->with("data",$this->data);
    }

    /**
     * Get the message envelope.
     */
   /*  public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Notify',
        );
    } */

    /**
     * Get the message content definition.
     */
    /* public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    } */

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    /* public function attachments(): array
    {
        return [];
    } */
}
