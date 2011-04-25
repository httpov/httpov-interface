<h3>Clients</h3>

<table id="clientTable" class="tablesorter">
  <thead>
  <tr>
    <th>all</th>
    <th>idle</th>
    <th>running</th>
  </tr>
  </thead>
  <tbody>
  <tr>

{section name=id loop=$res_c_a}
    <td align="right">{$res_c_a[id]->c}</td>
{/section}

{section name=id loop=$res_c_s}
    <td align="right">{$res_c_s[id]->c}</td>
{/section}

{section name=id loop=$res_c_r}
    <td align="right">{$res_c_r[id]->c}</td>
{/section}

  </tr>
  </tbody>
</table>

<h3>Jobs</h3>

<table id="jobTable" class="tablesorter">
  <thead>
  <tr>
    <th>all</th>
    <th>queued</th>
    <th>running</th>
    <th>finished</th>
  </tr>
  </thead>
  <tbody>
  <tr>

{section name=id loop=$res_a}
    <td align="right">{$res_a[id]->jobs}</td>
{/section}

{section name=id loop=$res_q}
    <td align="right">{$res_q[id]->jobs}</td>
{/section}

{section name=id loop=$res_r}
    <td align="right">{$res_r[id]->jobs}</td>
{/section}

{section name=id loop=$res_f}
    <td align="right">{$res_f[id]->jobs}</td>
{/section}

  </tr>
  </tbody>
</table>
