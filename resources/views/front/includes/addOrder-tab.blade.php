<div role="tabpanel" class="tab-pane fade shipping" id="other">

    <form method="POST" action="makeorder" accept-charset="UTF-8" class="row"><input
            name="_token" type="hidden"
            value="aGTrIT6V6AoEvSErC7intFQR85xg2xLN4ZmrKb2W" />
        <div class="alert alert-success">

        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> تفاصيل الطلب </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>رقم الطلب </td>
                        <td><input type="text" name="order_number" value="ExpC-45FB54" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>معلومات المرسل</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>الاسم <i>* </i></td>
                        <td><input name="name_from" type="text" required="required" placeholder="الاسم" /></td>
                    </tr>
                    <tr>
                        <td>اسم الشركة </td>
                        <td><input name="company_from" type="text" placeholder="اسم الشركة" /></td>
                    </tr>
                    <tr>
                        <td>المحافظه <i>*</i></td>
                        <td>
                            <select name="country_to" class="w-100">
                                <option>اختر اسم المحافظه</option>
                                <option value="1">الإسكندرية</option>
                                <option value="3">الإسماعيلية</option>
                                <option value="4">أسوان</option>
                                <option value="5">أسيوط</option>
                                <option value="6">الأقصر</option>
                                <option value="7">البحر الأحمر</option>
                                <option value="8">البحيرة</option>
                                <option value="9">بني سويف</option>
                                <option value="10">بورسعيد</option>
                                <option value="11">جنوب سيناء</option>
                                <option value="12">الجيزة</option>
                                <option value="13">الدقهلية</option>
                                <option value="14">دمياط</option>
                                <option value="15">سوهاج </option>
                                <option value="16">السويس</option>
                                <option value="17">الشرقية</option>
                                <option value="18">شمال سيناء</option>
                                <option value="19">الغربية</option>
                                <option value="20">الفيوم</option>
                                <option value="21">القاهرة</option>
                                <option value="22">القليوبية</option>
                                <option value="23">قنا</option>
                                <option value="24">كفر الشيخ</option>
                                <option value="25">مطروح</option>
                                <option value="26">المنوفية</option>
                                <option value="27">المنيا</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>المدينة <i>*</i></td>
                        <td><input name="city_from" type="text" placeholder="اكتب اسم مدينتك" /></td>
                    </tr>
                    <tr>
                        <td>العنوان <i>* </i></td>
                        <td><input name="address_from" type="text" placeholder="العنوان" /></td>
                    </tr>
                    <tr>
                        <td>رقم الموبيل <i>* </i></td>
                        <td><input name="mobile_from" type="text" placeholder="اكتب رقم الموبيل" /></td>
                    </tr>
                    <tr>
                        <td>نوع الشحنة <i>* </i></td>
                        <td><input name="order_type" type="text" placeholder="ماهو نوع شحنتك" /></td>
                    </tr>
                    <tr>
                        <td>وزن الشحنة <i>* </i></td>
                        <td><input name="order_value" type="text" placeholder="وزن الشحنة" /></td>
                    </tr>
                    <tr>
                        <td>نوع الشحن <i>* </i></td>
                        <td>
                            <select name="order_type_id" class="w-100">
                                <option />اختر نوع الشحن
                                <option value="1" />توصيل في نفس اليوم
                                <option value="2" />توصيل تانى يوم
                                <option value="3" />توصيل محافظات
                                <option value="5" />شحن دولي
                                <option value="6" />خدمة التغليف
                                <option value="7" />خدمة المراسلين
                                <option value="8" />خدمة ارسال المرسلات
                                <option value="9" />خدمة توصيل المستندات
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>مبلغ التحصيل <i>* </i></td>
                        <td><input name="collection_amount" type="text" placeholder="مبلغ التحصيل " /></td>
                    </tr>
                    <tr>
                        <td>الرمز البريدى </td>
                        <td><input name="zip_code_from" type="text" placeholder="الرمز البريدى" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>معلومات المستلم </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>الأسم <i>* </i>
                        </td>
                        <td><input name="name_to" type="text" placeholder="الأسم" />
                        </td>
                    </tr>
                    <tr>
                        <td>اسم الشركة</td>
                        <td><input name="company_to" type="text" placeholder="اسم الشركة" /></td>
                    </tr>
                    <tr>
                        <td>المحافظه <i>*</i></td>
                        <td>
                            <select name="country_to" class="w-100">
                                <option>اختر اسم المحافظه</option>
                                <option value="1">الإسكندرية</option>
                                <option value="3">الإسماعيلية</option>
                                <option value="4">أسوان</option>
                                <option value="5">أسيوط</option>
                                <option value="6">الأقصر</option>
                                <option value="7">البحر الأحمر</option>
                                <option value="8">البحيرة</option>
                                <option value="9">بني سويف</option>
                                <option value="10">بورسعيد</option>
                                <option value="11">جنوب سيناء</option>
                                <option value="12">الجيزة</option>
                                <option value="13">الدقهلية</option>
                                <option value="14">دمياط</option>
                                <option value="15">سوهاج </option>
                                <option value="16">السويس</option>
                                <option value="17">الشرقية</option>
                                <option value="18">شمال سيناء</option>
                                <option value="19">الغربية</option>
                                <option value="20">الفيوم</option>
                                <option value="21">القاهرة</option>
                                <option value="22">القليوبية</option>
                                <option value="23">قنا</option>
                                <option value="24">كفر الشيخ</option>
                                <option value="25">مطروح</option>
                                <option value="26">المنوفية</option>
                                <option value="27">المنيا</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>المدينة <i>*</i></td>
                        <td><input name="city_to" type="text" placeholder="اكتب اسم مديينتك" /></td>
                    </tr>
                    <tr>
                        <td>العنوان <i>* </i></td>
                        <td><input name="address_to" type="text" placeholder="العنوان" /></td>
                    </tr>
                    <tr>
                        <td>رقم الموبيل <i>* </i></td>
                        <td><input name="mobile_to" type="text" placeholder="اكتب رقم الموبيل" /></td>
                    </tr>
                    <tr>
                        <td>الرمز البريدى </td>
                        <td><input name="zip_code_to" type="text" placeholder="الرمز البريدى" /></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-xs-12 button-s my-2 text-center">
            <button type="submit" class="btn-success btn btn-lg">تاكيد الطلب</button>
        </div>
    </form>
</div>
