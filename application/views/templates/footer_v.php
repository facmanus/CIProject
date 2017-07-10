<footer id="footer">
	<dl>
		<dd><a class="azubu" href="https://github.com/facmanus/CIProject" target="blank">fac.manus</a></dd>
		<dd>Copyright by <em class="black">fac.manus</em></dd>
	</dl>
</footer>

</div>

<!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
<script src="/include/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function() {
		$("#btn_signout").click(function() {
			document.location.href="/index.php/auth/logout";
		});
	});
</script>
</body>
</html>

