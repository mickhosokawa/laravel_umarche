<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    //
    public function showServiceContainerTest()
    {
        app()->bind('lifeCycleTest', function(){
            return 'ライフサイクルテスト';
        });
        /* bindの中身を取得 */
        $test = app()->make('lifeCycleTest');
        
        // サービスコンテナなしのパターン
        // $message = new Message();
        // $sample  = new Sample($message);
        // $sample->run();

        // サービスコンテナありのパターン
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();

        dd($test, app());
    }
}

class Sample
{
    public $message;

    // クラスを引数に取ると自動的にインスタンス化ができる
    // DIという仕組み
    public function __construct(Message $message){
        // Messageクラスがこの$messageに入る
        // つまり、echo('メッセージ表示')のことをさす
        $this->message = $message;
    }

    public function run(){
        // MessageクラスのSend()メソッドを利用する
        $this->message->send();
    }
}
class Message
{
    public function send()
    {
        echo('メッセージ表示');
    }
}