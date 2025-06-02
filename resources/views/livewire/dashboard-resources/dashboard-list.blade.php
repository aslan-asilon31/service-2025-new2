<div>

  <tr>
    <td>Name:</td>
    <td>
      <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}">
    </td>
  </tr>
  <tr>
    <td>Email:</td>
    <td>
      <input type="text" name="email" value="{{ Auth::guard('admin')->user()->email }}">
    </td>
  </tr>
</div>
