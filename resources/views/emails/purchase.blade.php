<p>━━━━━━━━━━━━━━━━━━━━</p>
<p>本メールは送信専用です。</p>
<p>━━━━━━━━━━━━━━━━━━━━</p>


<p>{{ $name }}様</p>

<p>{{ $subtitle }}</p>

<p>===お申し込み内容===</p>

<p>{{ $title }}</p>

<p>＜詳細＞</p>

<p>{!! nl2br(htmlspecialchars($content)) !!}</p>

<p>日時：{{ $event_date }}</p>

<p>会場：{{ $venue }}</p>

<p>講師：{{ $administrator }}</p>

<p>＜参加費＞</p>

<p>■{{ $product_name }}</p>

<p>■{{ number_format($price) }}円</p>

<p>{!! nl2br(htmlspecialchars($bank_info)) !!}</p>

<p>━━━━━━━━━━━━━━━━━</p>

<p>株式会社NARU　水江卓也</p>

<p>info@naru.pics</p>

<p>━━━━━━━━━━━━━━━━━</p>