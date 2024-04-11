<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 10px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: green; font-size: 26px;"><strong>EasyShop</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               Seller: {{ $data->seller->shop_name }} <br>
               Email:{{ Auth::user()->email }} <br>
               Ph: {{ $data->seller->phone }} <br>
               〒{{ $data->seller->zip_code }} <br>
               {{ $data->prefecture->name }}{{ $data->seller->city }}{{ $data->seller->chome }}{{ $data->seller->building }}{{ $data->seller->room }} <br>
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> Name <br>
           <strong>Email:</strong> Email <br>
           <strong>Phone:</strong> Phone <br>
           <strong>Address:</strong> Address <br>
           <strong>Post Code:</strong> Post Code
         </p>
        </td>

        <td style="text-align: right;">
            <h3><span style="color: green;">Order ID:</span>{{ $data->id }}</h3>
            Order Date: {{ $data->created_at }} <br>
            Delivery Date: {{ $data->shipped_date }} <br>
            Payment Type : {{ $data->payment_method }}
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Unit Price </th>
      </tr>
    </thead>
    <tbody>


      <tr class="font">
        <td align="center">{{ $data->product->product_code }}</td>
        <td align="center">{{ $data->product->product_name }}</td>
        <td align="center">{{ $data->size }}</td>
        <td align="center">{{ $data->color }}</td>
        <td align="center">{{ $data->qty }}</td>
        <td align="center">&yen;{{ $data->price }}</td>
      </tr>

    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: green;">Subtotal:</span> &yen;{{ $data->amount }}</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p align="center">{{$data->seller->shop_name}}</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>
